<?php
declare(strict_types = 1);

namespace TYPO3\CMS\Core\Routing\Legacy;

use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Query\QueryBuilder;
use TYPO3\CMS\Core\Routing\Aspect\PersistenceDelegate;
use TYPO3\CMS\Core\Utility\GeneralUtility;

trait PersistedPatternMapperLegacyTrait
{
    /**
     * @var PersistenceDelegate
     */
    protected $persistenceDelegate;

    /**
     * @return PersistenceDelegate
     * @deprecated since TYPO3 v10.3, will be removed in TYPO3 v11.0
     */
    protected function getPersistenceDelegate(): PersistenceDelegate
    {
        if ($this->persistenceDelegate !== null) {
            return $this->persistenceDelegate;
        }
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getQueryBuilderForTable($this->tableName)
            ->from($this->tableName);
        // @todo Restrictions (Hidden? Workspace?)

        $resolveModifier = function (QueryBuilder $queryBuilder, array $values) {
            return $queryBuilder->select('*')->where(
                ...$this->createFieldConstraints($queryBuilder, $values, true)
            );
        };
        $generateModifier = function (QueryBuilder $queryBuilder, array $values) {
            return $queryBuilder->select('*')->where(
                ...$this->createFieldConstraints($queryBuilder, $values)
            );
        };

        return $this->persistenceDelegate = new PersistenceDelegate(
            $queryBuilder,
            $resolveModifier,
            $generateModifier
        );
    }

    /**
     * @param QueryBuilder $queryBuilder
     * @param array $values
     * @param bool $resolveExpansion
     * @return array
     * @deprecated since TYPO3 v10.3, will be removed in TYPO3 v11.0
     */
    protected function createFieldConstraints(
        QueryBuilder $queryBuilder,
        array $values,
        bool $resolveExpansion = false
    ): array {
        $languageExpansion = $this->languageParentFieldName
            && $resolveExpansion
            && isset($values['uid']);

        $constraints = [];
        foreach ($values as $fieldName => $fieldValue) {
            if ($languageExpansion && $fieldName === 'uid') {
                continue;
            }
            $constraints[] = $queryBuilder->expr()->eq(
                $fieldName,
                $queryBuilder->createNamedParameter(
                    $fieldValue,
                    \PDO::PARAM_STR
                )
            );
        }
        // If requested, either match uid or language parent field value
        if ($languageExpansion) {
            $idParameter = $queryBuilder->createNamedParameter(
                $values['uid'],
                \PDO::PARAM_INT
            );
            $constraints[] = $queryBuilder->expr()->orX(
                $queryBuilder->expr()->eq('uid', $idParameter),
                $queryBuilder->expr()->eq($this->languageParentFieldName, $idParameter)
            );
        }

        return $constraints;
    }
}
