<?php
namespace Concrete\Package\Betong;

use BlockType;
use BlockTypeSet;
use CollectionAttributeKey;
use CollectionType;
use Concrete\Core\Attribute\Key\Category as AttributeKeyCategory;
use Concrete\Core\Attribute\Key\CollectionKey as CollectionKey;
use Concrete\Core\Attribute\Set as AttributeSet;
use Concrete\Core\File\Set\Set;
use Concrete\Core\Page\Page;
use Concrete\Core\Page\Single as SinglePage;
use Concrete\Core\Page\Template as PageTemplate;
use Concrete\Core\Page\Type\Composer\Control\CollectionAttributeControl as AttributeControl;
use Concrete\Core\Page\Type\Composer\Control\Control;
use Concrete\Core\Page\Type\Composer\Control\CorePageProperty\CorePageProperty;
use Concrete\Core\Page\Type\Composer\Control\CorePageProperty\DescriptionCorePageProperty;
use Concrete\Core\Page\Type\Composer\Control\CorePageProperty\NameCorePageProperty;
use Concrete\Core\Page\Type\Composer\Control\CorePageProperty\PageTemplateCorePageProperty;
use Concrete\Core\Page\Type\Composer\Control\CorePageProperty\PublishTargetCorePageProperty;
use Concrete\Core\Page\Type\Composer\Control\CorePageProperty\UrlSlugCorePageProperty;
use Concrete\Core\Page\Type\Composer\Control\Type\BlockType as ComposerBlockType;
use Concrete\Core\Page\Type\Composer\FormLayoutSet;
use Concrete\Core\Page\Type\Composer\FormLayoutSetControl;
use Concrete\Core\Page\Type\Type as PageType;
use Exception;
use Loader;
use Package;
use Route;

class Controller extends Package
{

    protected $pkgHandle = 'betong';
    protected $appVersionRequired = '5.7.5.9';
    protected $pkgVersion = '0.0.1';
    private $blockTypeSetHandle = 'betong';

    private $blockTypeSetName = 'betong';

    public function on_start()
    {
        $this->registerRoutes();
    }

    public function getPackageDescription()
    {
        return t("Betong boilerplate package");
    }

    public function getPackageName()
    {
        return t("Betong");
    }

    public function install()
    {
        $pkg = parent::install();

        $this->installOrUpgrade($pkg);
    }

    public function upgrade()
    {
        parent::upgrade();

        $pkg = Package::getByHandle($this->pkgHandle);

        $this->installOrUpgrade($pkg);
    }

    private function installOrUpgrade($pkg)
    {
        $this->installAttributes($pkg);
        $this->installBlockTypeSet($pkg);
        $this->installBlockTypes($pkg);
        $this->installPageTemplates($pkg);
        $this->installPageTypes($pkg);
        $this->installComposerFields($pkg);
        $this->installPages($pkg);
        $this->installFileSets($pkg);
    }

    private function installBlockTypes($pkg)
    {
        //$this->installBlockType('hero', $pkg);
    }

    public function installPageTypes($pkg)
    {
        //$this->installPageType('team_member', 'Team Member', true, 'default', $pkg);
    }

    public function installAttributes($pkg)
    {
        $attributeSet = $this->installAttributeSet($pkg);

        //$this->installImageAttribute($pkg, $attributeSet, 'header_image', 'Header image');
    }

    private function installPages($pkg)
    {
        //SinglePage::add('/dashboard/mail/', $pkg);
    }

    private function installPageTemplates($pkg)
    {
        //$this->installPageTemplate('page_startpage', 'Startpage', $pkg);
    }

    private function registerRoutes()
    {
        //Route::register('/url',
        //    '\Concrete\Package\Betong\Controller\controller::action'
        //);
    }

    private function installComposerFields($pkg)
    {
        //$this->installNewsItemFields($pkg);
    }

      private function installFileSets($pkg)
    {
        //$this->installFileSet('Images');
    }

    private function installNewsItemFields($pkg)
    {
        // $pt = PageType::getByHandle('page_news_item');
        // $formData = $this->addBasicFields($pt);
        // $set = $formData["set"];
        // $newsImage = $this->getComposerCustomAttribute('news_item_image');
        // $imageControl = $this->addFormControl($set, $newsImage, 'News image');
    }

    private function installBlockType($blockTypeHandle, $pkg)
    {
        $bt = BlockType::getByHandle($blockTypeHandle);
        if (!is_object($bt)) {
            $bt = BlockType::installBlockType($blockTypeHandle, $pkg);
        }
        $blockTypeSet = BlockTypeSet::getByHandle($this->blockTypeSetHandle);
        $blockTypeSet->addBlockType($bt);
    }

    private function installAttributeSet($pkg)
    {
        $attributeKeyCategory = AttributeKeyCategory::getByHandle('collection');

        $attributeKeyCategory->setAllowAttributeSets(AttributeKeyCategory::ASET_ALLOW_SINGLE);
        $attributeSet = AttributeSet::getByHandle($this->pkgHandle);
        if (!is_object($attributeSet)) {
            $attributeSet = $attributeKeyCategory->addSet($this->pkgHandle, $this->getPackageName(), $pkg);
        }

        return $attributeSet;
    }

    private function installImageAttribute($pkg, $attributeSet, $handle, $name)
    {
        $imageKey = CollectionAttributeKey::getByHandle($handle);
        if (!$imageKey || !intval($imageKey)) {
            $imageKey = CollectionAttributeKey::add('image_file', array(
                'akHandle'              => $handle,
                'akName'                => $name,
                'akIsSearchable'        => false,
                'akIsSearchableIndexed' => false,
                'akTextareaDisplayMode' => 'rich_text'
            ), $pkg);
            $imageKey->setAttributeSet($attributeSet);
        }
    }

    private function installTextareaAttribute($pkg, $attributeSet, $handle, $name)
    {
        $textareaKey = CollectionAttributeKey::getByHandle($handle);
        if (!$textareaKey || !intval($textareaKey)) {
            $textareaKey = CollectionAttributeKey::add('textarea', array(
                'akHandle'              => $handle,
                'akName'                => $name,
                'akIsSearchable'        => true,
                'akIsSearchableIndexed' => true,
                'akTextareaDisplayMode' => 'rich_text'
            ), $pkg);
            $textareaKey->setAttributeSet($attributeSet);
        }
    }

    private function installTextAttribute($pkg, $attributeSet, $handle, $name)
    {
        $textareaKey = CollectionAttributeKey::getByHandle($handle);
        if (!$textareaKey || !intval($textareaKey)) {
            $textareaKey = CollectionAttributeKey::add('text', array(
                'akHandle'              => $handle,
                'akName'                => $name,
                'akIsSearchable'        => true,
                'akIsSearchableIndexed' => true,
                'akTextareaDisplayMode' => 'text'
            ), $pkg);
            $textareaKey->setAttributeSet($attributeSet);
        }
    }

    private function installFileAttribute($pkg, $attributeSet, $handle, $name)
    {
        $textareaKey = CollectionAttributeKey::getByHandle($handle);
        if (!$textareaKey || !intval($textareaKey)) {
            $textareaKey = CollectionAttributeKey::add('image_file', array(
                'akHandle'              => $handle,
                'akName'                => $name,
                'akIsSearchable'        => true,
                'akIsSearchableIndexed' => true
            ), $pkg);
            $textareaKey->setAttributeSet($attributeSet);
        }
    }

    private function installTopicsAttribute($pkg, $attributeSet, $handle, $name)
    {
        $textareaKey = CollectionAttributeKey::getByHandle($handle);
        if (!$textareaKey || !intval($textareaKey)) {
            $textareaKey = CollectionAttributeKey::add('topics', array(
                'akHandle'              => $handle,
                'akName'                => $name,
                'akIsSearchable'        => true,
                'akIsSearchableIndexed' => true,
            ), $pkg);
            $textareaKey->setAttributeSet($attributeSet);
        }
    }

    private function installPage($name, $handle, $location, $pageTypeHandle, $pageThemeHandle)
    {
        $parentPage = null;
        if ($location) {
            $parentPage = Page::getByPath($location);
        }
        else {
            $location = '';
            $parentPage = Page::getByID(1);
        }

        $page = Page::getByPath($location . ' / ' . $handle);
        if ($page->getCollectionID()) { // already installed
            return;
        }
        $pageType = PageType::getByHandle($pageTypeHandle);
        $template = PageTemplate::getByHandle($pageThemeHandle);

        if ($pageType == null) {
            throw new Exception('Sidtyp med handtag ' . $pageTypeHandle . ' saknas!');
        }
        if ($template == null) {
            throw new Exception('Sidtema med handtag ' . $pageThemeHandle . ' saknas!');
        }

        $parentPage->add($pageType, array(
            'cName'   => $name,
            'cHandle' => $handle
        ), $template);
    }

    private function installBlockTypeSet($pkg)
    {
        if (!is_object(BlockTypeSet::getByHandle($this->blockTypeSetHandle))) {
            BlockTypeSet::add($this->blockTypeSetHandle, $this->blockTypeSetName, $pkg);
        }
    }

    public function installPageType($handle, $name, $composer = false, $page_template = 'full', $pkg)
    {
        $data = array();
        $data['handle'] = $handle;
        $data['name'] = $name;
        $data['ptLaunchInComposer'] = $composer;
        $data['allowedTemplates'] = false;
        $data['defaultTemplate'] = PageTemplate::getByHandle($page_template);

        if (!PageType::getByHandle($handle)) {
            PageType::add($data, $pkg);
            $this->addBasicFields(PageType::getByHandle($handle));
        }
    }

    private function installPageTemplate($handle, $name, $pkg)
    {
        $template = PageTemplate::getByHandle($handle);
        if (!$template) {
            PageTemplate::add($handle, $name, FILENAME_PAGE_TEMPLATE_DEFAULT_ICON, $pkg);
        }
    }

    private function addBasicFields(PageType $pt, $setName = "Basics")
    {
        /* @var FormLayoutSet $set */
        $set = $this->addComposerLayoutSet($pt, $setName, "");
        $added = $this->addFormControl($set, new NameCorePageProperty(), "Page Name");
        $added->updateFormLayoutSetControlRequired(true);

        return [
            "set"            => $set,
            "name"           => $added,
            "description"    => $this->addFormControl($set, new DescriptionCorePageProperty()),
            "url_slug"       => $this->addFormControl($set, new UrlSlugCorePageProperty()),
            "publish_target" => $this->addFormControl($set, new PublishTargetCorePageProperty()),
            "page_template"  => $this->addFormControl($set, new PageTemplateCorePageProperty())
        ];
    }

    private function getComposerBlock($handle)
    {
        return (new ComposerBlockType())->configureFromImportHandle($handle);
    }

    private function getComposerCustomAttribute($handle)
    {
        $attributeControl = new AttributeControl();
        $attributeKeyID = CollectionKey::getByHandle($handle)->getAttributeKeyID();
        $attributeControl->setAttributeKeyID($attributeKeyID);

        return $attributeControl;
    }

    /**
     * @param PageType $pageType
     * @param $name
     * @param string $desc
     * @return FormLayoutSet
     */
    private function addComposerLayoutSet(PageType $pageType, $name = "", $desc = "")
    {
        $layouts = FormLayoutSet::getList($pageType);
        $layout = array_filter($layouts, function ($item) use ($name) {
            /* @var FormLayoutSet $item */
            return ($item->getPageTypeComposerFormLayoutSetName() == $name);
        });

        return (count($layout) > 0) ? $layout[0] : $pageType->addPageTypeComposerFormLayoutSet($name, $desc);
    }

    /**
     * @param FormLayoutSet $set
     * @param CorePageProperty $controlType
     * @param $name
     * @param string $desc
     * @return FormLayoutSetControl
     */
    private function addFormControl(FormLayoutSet $set, Control $controlType, $name = "", $desc = "")
    {
        $controls = FormLayoutSetControl::getList($set);
        $control = array_values(array_filter($controls, function ($item) use ($name, $controlType) {
            /* @var FormLayoutSetControl $item */
            if (trim($name) != "") {
                return ($item->getPageTypeComposerFormLayoutSetControlCustomLabel() == $name);
            }
            else {
                return ($item->getPageTypeComposerControlObject()->getPageTypeComposerControlIdentifier() == $controlType->getPageTypeComposerControlIdentifier());

            }
        }));

        $control = (count($control) > 0) ? $control[0] : $controlType->addToPageTypeComposerFormLayoutSet($set);
        if ($name != "")
            $control->updateFormLayoutSetControlCustomLabel($name);
        if ($desc != "")
            $control->updateFormLayoutSetControlDescription($desc);

        return $control;
    }

    private function installFileSet($name)
    {
        return Set::createAndGetSet(
            $name,
            Set::TYPE_PUBLIC
        );
    }
}