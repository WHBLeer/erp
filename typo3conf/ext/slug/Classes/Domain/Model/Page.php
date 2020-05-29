<?php
namespace SIMONKOEHLER\Slug\Domain\Model;

/*
 * This file was created by Simon Köhler
 * https://simon-koehler.com
 */

class Page extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

    /**
    * @var string
    */
    protected $title;

    /**
    * @var integer
    */
    protected $uid;

    /**
    * @var integer
    */
    protected $l10nParent;

    /**
    * @var integer
    */
    protected $doktype;

    /**
    * @var integer
    */
    protected $language;

    /**
     * Determines if a page is hidden
     *
     * @var bool
     */
    protected $hidden = false;

    /**
    * @var string
    */
    protected $slug;

    /**
     * Determines if a page is a site root
     *
     * @var bool
     */
    protected $isSiteroot = false;

    /**
     * Lock the slug, so that it can not be edited or overwritten by any other
     * function.
     *
     * @var bool
     */
    protected $slugLock = false;

    /**
     * Returns the uid
     *
     * @return integer $uid
     */
    public function getUid()
    {
        return $this->uid;
    }

    /**
     * Returns the l10nParent
     *
     * @return integer $l10nParent
     */
    public function getL10nParent()
    {
        return $this->l10nParent;
    }

    /**
     * Returns the doktype
     *
     * @return integer $doktype
     */
    public function getDoktype()
    {
        return $this->doktype;
    }

    /**
     * Returns the language
     *
     * @return integer $language
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Returns the hidden
     *
     * @return bool $hidden
     */
    public function getHidden()
    {
        return $this->hidden;
    }

    /**
     * Returns the isSiteroot
     *
     * @return bool $isSiteroot
     */
    public function getIsSiteroot()
    {
        return $this->isSiteroot;
    }

    /**
     * Returns the slug
     *
     * @return bool $slug
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Returns the slugLock
     *
     * @return bool $slugLock
     */
    public function getSlugLock()
    {
        return $this->slugLock;
    }

    /**
     * Sets the slugLock
     *
     * @param bool $slugLock
     * @return void
     */
    public function setSlugLock($slugLock)
    {
        $this->slugLock = $slugLock;
    }

    /**
     * Returns the boolean state of slugLock
     *
     * @return bool
     */
    public function isSlugLock()
    {
        return $this->slugLock;
    }

    /**
     * Returns the title of the page
     *
     * @return string
     */
    public function getTitle() {
	return $this->title;
    }

}
