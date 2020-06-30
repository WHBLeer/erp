<?php
namespace TYPO3\CMS\Core\Messaging;

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

use TYPO3\CMS\Core\Authentication\AbstractUserAuthentication;
use TYPO3\CMS\Core\Messaging\Renderer\FlashMessageRendererInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * A class which collects and renders flash messages.
 */
class FlashMessageQueue extends \SplQueue implements \JsonSerializable
{
    /**
     * A unique identifier for this queue
     *
     * @var string
     */
    protected $identifier;

    /**
     * @param string $identifier The unique identifier for this queue
     */
    public function __construct($identifier)
    {
        $this->identifier = $identifier;
    }

    /**
     * @return string
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * Adds a message either to the BE_USER session (if the $message has the storeInSession flag set)
     * or it enqueues the message.
     *
     * @param FlashMessage $message Instance of \TYPO3\CMS\Core\Messaging\FlashMessage, representing a message
     * @throws \TYPO3\CMS\Core\Exception
     * @return FlashMessageQueue Self to allow chaining
     */
    public function enqueue($message): FlashMessageQueue
    {
        if (!($message instanceof FlashMessage)) {
            throw new \TYPO3\CMS\Core\Exception(
                'FlashMessageQueue::enqueue() expects an object of type \TYPO3\CMS\Core\Messaging\FlashMessage but got type "' . (is_object($message) ? get_class($message) : gettype($message)) . '"',
                1376833554
            );
        }
        if ($message->isSessionMessage()) {
            $this->addFlashMessageToSession($message);
        } else {
            parent::enqueue($message);
        }
        return $this;
    }

    /**
     * @param FlashMessage $message
     */
    public function addMessage(FlashMessage $message)
    {
        $this->enqueue($message);
    }

    /**
     * This method is empty, as it will not move any flash message (e.g. from the session)
     */
    public function dequeue()
    {
        // deliberately empty
    }

    /**
     * Adds the given flash message to the array of
     * flash messages that will be stored in the session.
     *
     * @param FlashMessage $message
     */
    protected function addFlashMessageToSession(FlashMessage $message)
    {
        $queuedFlashMessages = $this->getFlashMessagesFromSession();
        $queuedFlashMessages[] = $message;
        $this->storeFlashMessagesInSession($queuedFlashMessages);
    }

    /**
     * Returns all messages from the current PHP session and from the current request.
     *
     * @param int $severity Optional severity, must be one of \TYPO3\CMS\Core\Messaging\AbstractMessage constants
     * @return FlashMessage[]
     */
    public function getAllMessages($severity = null)
    {
        // Get messages from user session
        $queuedFlashMessagesFromSession = $this->getFlashMessagesFromSession();
        $queuedFlashMessages = array_merge($queuedFlashMessagesFromSession, $this->toArray());
        if ($severity !== null) {
            $filteredFlashMessages = [];
            foreach ($queuedFlashMessages as $message) {
                if ($message->getSeverity() === $severity) {
                    $filteredFlashMessages[] = $message;
                }
            }
            return $filteredFlashMessages;
        }

        return $queuedFlashMessages;
    }

    /**
     * Returns all messages from the current PHP session and from the current request.
     * After fetching the messages the internal queue and the message queue in the session
     * will be emptied.
     *
     * @param int $severity Optional severity, must be one of \TYPO3\CMS\Core\Messaging\AbstractMessage constants
     * @return FlashMessage[]
     */
    public function getAllMessagesAndFlush($severity = null)
    {
        $queuedFlashMessages = $this->getAllMessages($severity);
        // Reset messages in user session
        $this->removeAllFlashMessagesFromSession($severity);
        // Reset internal messages
        $this->clear($severity);
        return $queuedFlashMessages;
    }

    /**
     * Stores given flash messages in the session
     *
     * @param FlashMessage[] $flashMessages
     */
    protected function storeFlashMessagesInSession(array $flashMessages = null)
    {
        $this->getUserByContext()->setAndSaveSessionData($this->identifier, $flashMessages);
    }

    /**
     * Removes all flash messages from the session
     *
     * @param int $severity Optional severity, must be one of \TYPO3\CMS\Core\Messaging\AbstractMessage constants
     */
    protected function removeAllFlashMessagesFromSession($severity = null)
    {
        if (!$this->getUserByContext() instanceof AbstractUserAuthentication) {
            return;
        }
        if ($severity === null) {
            $this->storeFlashMessagesInSession(null);
        } else {
            $messages = $this->getFlashMessagesFromSession();
            foreach ($messages as $index => $message) {
                if ($message->getSeverity() === $severity) {
                    unset($messages[$index]);
                }
            }
            $this->storeFlashMessagesInSession($messages);
        }
    }

    /**
     * Returns current flash messages from the session, making sure to always
     * return an array.
     *
     * @return FlashMessage[]
     */
    protected function getFlashMessagesFromSession(): array
    {
        $sessionMessages = [];
        $user = $this->getUserByContext();
        if ($user instanceof AbstractUserAuthentication) {
            $sessionMessages = $user->getSessionData($this->identifier);
            $sessionMessages = is_array($sessionMessages) ? $sessionMessages : [];
        }
        return $sessionMessages;
    }

    /**
     * Gets user object by context
     *
     * @return AbstractUserAuthentication
     */
    protected function getUserByContext()
    {
        return TYPO3_MODE === 'BE' ? $GLOBALS['BE_USER'] : $GLOBALS['TSFE']->fe_user;
    }

    /**
     * Fetches and renders all available flash messages from the queue.
     *
     * @param FlashMessageRendererInterface|null $flashMessageRenderer
     * @return string All flash messages in the queue rendered by context based FlashMessageRendererResolver.
     */
    public function renderFlashMessages(FlashMessageRendererInterface $flashMessageRenderer = null)
    {
        $content = '';
        $flashMessages = $this->getAllMessagesAndFlush();

        if (!empty($flashMessages)) {
            if ($flashMessageRenderer === null) {
                $flashMessageRenderer = GeneralUtility::makeInstance(FlashMessageRendererResolver::class)->resolve();
            }
            $content = $flashMessageRenderer->render($flashMessages);
        }

        return $content;
    }

    /**
     * Returns all items of the queue as array
     *
     * @return FlashMessage[]
     */
    public function toArray()
    {
        $array = [];
        $this->rewind();
        while ($this->valid()) {
            $array[] = $this->current();
            $this->next();
        }
        return $array;
    }

    /**
     * Removes all items from the queue
     *
     * @param int $severity Optional severity, must be one of \TYPO3\CMS\Core\Messaging\AbstractMessage constants
     */
    public function clear($severity = null)
    {
        $this->rewind();
        if ($severity === null) {
            while (!$this->isEmpty()) {
                parent::dequeue();
            }
        } else {
            $keysToRemove = [];
            while ($cur = $this->current()) {
                if ($cur->getSeverity() === $severity) {
                    $keysToRemove[] = $this->key();
                }
                $this->next();
            }
            // keys are renumbered when unsetting elements
            // so unset them from last to first
            $keysToRemove = array_reverse($keysToRemove);
            foreach ($keysToRemove as $key) {
                $this->offsetUnset($key);
            }
        }
    }

    /**
     * @return array Data which can be serialized by json_encode()
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
