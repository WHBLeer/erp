<?php
namespace TYPO3\CMS\Core\Resource\Service;

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

use TYPO3\CMS\Core\Resource;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\MathUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Extbase\SignalSlot\Dispatcher;

/**
 * File processing service
 */
class FileProcessingService
{
    /**
     * @var Resource\ResourceStorage
     */
    protected $storage;

    /**
     * @var Resource\Driver\DriverInterface
     */
    protected $driver;

    /**
     * @var Dispatcher
     */
    protected $signalSlotDispatcher;

    const SIGNAL_PreFileProcess = 'preFileProcess';
    const SIGNAL_PostFileProcess = 'postFileProcess';

    /**
     * Creates this object.
     *
     * @param Resource\ResourceStorage $storage
     * @param Resource\Driver\DriverInterface $driver
     */
    public function __construct(Resource\ResourceStorage $storage, Resource\Driver\DriverInterface $driver)
    {
        $this->storage = $storage;
        $this->driver = $driver;
    }

    /**
     * Processes a file
     *
     * @param Resource\FileInterface $fileObject The file object
     * @param Resource\ResourceStorage $targetStorage The storage to store the processed file in
     * @param string $taskType
     * @param array $configuration
     *
     * @return Resource\ProcessedFile
     * @throws \InvalidArgumentException
     */
    public function processFile(Resource\FileInterface $fileObject, Resource\ResourceStorage $targetStorage, $taskType, $configuration)
    {
        // Enforce default configuration for preview processing here,
        // to be sure we find already processed files below,
        // which we wouldn't if we would change the configuration later, as configuration is part of the lookup.
        if ($taskType === Resource\ProcessedFile::CONTEXT_IMAGEPREVIEW) {
            $configuration = Resource\Processing\LocalPreviewHelper::preProcessConfiguration($configuration);
        }
        // Ensure that the processing configuration which is part of the hash sum is properly cast, so
        // unnecessary duplicate images are not produced, see #80942
        foreach ($configuration as &$value) {
            if (MathUtility::canBeInterpretedAsInteger($value)) {
                $value = (int)$value;
            }
        }

        /** @var Resource\ProcessedFileRepository $processedFileRepository */
        $processedFileRepository = GeneralUtility::makeInstance(Resource\ProcessedFileRepository::class);

        $processedFile = $processedFileRepository->findOneByOriginalFileAndTaskTypeAndConfiguration($fileObject, $taskType, $configuration);

        // set the storage of the processed file
        // Pre-process the file
        $this->emitPreFileProcessSignal($processedFile, $fileObject, $taskType, $configuration);

        // Only handle the file if it is not processed yet
        // (maybe modified or already processed by a signal)
        // or (in case of preview images) already in the DB/in the processing folder
        if (!$processedFile->isProcessed()) {
            $this->process($processedFile, $targetStorage);
        }

        // Post-process (enrich) the file
        $this->emitPostFileProcessSignal($processedFile, $fileObject, $taskType, $configuration);

        return $processedFile;
    }

    /**
     * Processes the file
     *
     * @param Resource\ProcessedFile $processedFile
     * @param Resource\ResourceStorage $targetStorage The storage to put the processed file into
     */
    protected function process(Resource\ProcessedFile $processedFile, Resource\ResourceStorage $targetStorage)
    {
        // We only have to trigger the file processing if the file either is new, does not exist or the
        // original file has changed since the last processing run (the last case has to trigger a reprocessing
        // even if the original file was used until now)
        if ($processedFile->isNew() || (!$processedFile->usesOriginalFile() && !$processedFile->exists()) ||
            $processedFile->isOutdated()) {
            $task = $processedFile->getTask();
            /** @var Resource\Processing\LocalImageProcessor $processor */
            $processor = GeneralUtility::makeInstance(Resource\Processing\LocalImageProcessor::class);
            $processor->processTask($task);

            if ($task->isExecuted() && $task->isSuccessful() && $processedFile->isProcessed()) {
                /** @var Resource\ProcessedFileRepository $processedFileRepository */
                $processedFileRepository = GeneralUtility::makeInstance(Resource\ProcessedFileRepository::class);
                $processedFileRepository->add($processedFile);
            }
        }
    }

    /**
     * Get the SignalSlot dispatcher
     *
     * @return Dispatcher
     */
    protected function getSignalSlotDispatcher()
    {
        if (!isset($this->signalSlotDispatcher)) {
            $this->signalSlotDispatcher = GeneralUtility::makeInstance(ObjectManager::class)->get(Dispatcher::class);
        }
        return $this->signalSlotDispatcher;
    }

    /**
     * Emits file pre-processing signal.
     *
     * @param Resource\ProcessedFile $processedFile
     * @param Resource\FileInterface $file
     * @param string $context
     * @param array $configuration
     */
    protected function emitPreFileProcessSignal(Resource\ProcessedFile $processedFile, Resource\FileInterface $file, $context, array $configuration = [])
    {
        $this->getSignalSlotDispatcher()->dispatch(
            Resource\ResourceStorage::class,
            self::SIGNAL_PreFileProcess,
            [$this, $this->driver, $processedFile, $file, $context, $configuration]
        );
    }

    /**
     * Emits file post-processing signal.
     *
     * @param Resource\ProcessedFile $processedFile
     * @param Resource\FileInterface $file
     * @param $context
     * @param array $configuration
     */
    protected function emitPostFileProcessSignal(Resource\ProcessedFile $processedFile, Resource\FileInterface $file, $context, array $configuration = [])
    {
        $this->getSignalSlotDispatcher()->dispatch(
            Resource\ResourceStorage::class,
            self::SIGNAL_PostFileProcess,
            [$this, $this->driver, $processedFile, $file, $context, $configuration]
        );
    }
}
