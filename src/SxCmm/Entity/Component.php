<?php
namespace SxCmm\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *  @ORM\Entity
 *  @ORM\Table(
 *      name="component",
 *      indexes={
 *          @ORM\index(name="page_id_idx", columns={"page_id"}),
 *          @ORM\index(name="area_idx", columns={"area"}),
 *          @ORM\index(name="type_idx", columns={"type"}),
 *          @ORM\index(name="search_idx", columns={"page_id", "area"})
 *      }
 *  )
 * @todo Fix keys for searching based on position, in case we're moving components.
 */
class Component
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var integer
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=200)
     * @var string
     */
    protected $page_id;

    /**
     * @ORM\Column(type="integer")
     * @var integer
     */
    protected $position;

    /**
     * @ORM\Column(type="string", length=200)
     * @var string
     */
    protected $area;

    /**
     * @ORM\Column(type="string", length=200)
     * @var string
     */
    protected $type;

    /**
     * @ORM\OneToMany(targetEntity="ComponentSetting", mappedBy="component", cascade={"persist", "remove", "merge"}, orphanRemoval=true)
     * @var ComponentSetting[]
     */
    protected $settings;

    /**
     * @var array map of settings
     */
    protected $settingsMap;

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getPageId()
    {
        return $this->page_id;
    }

    /**
     * @return string
     */
    public function getArea()
    {
        return $this->area;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return ComponentSetting[]
     */
    public function getSettings()
    {
        return $this->settings;
    }

    /**
     * Get a setting by key.
     *
     * @param   string      $key
     *
     * @return  null|string The value
     */
    public function getSetting($key)
    {
        if (empty($this->settingsMap)) {
            $this->mapSettings();
        }

        if (!isset($this->settingsMap[$key])) {
            return null;
        }

        return $this->settingsMap[$key];
    }

    /**
     * Map the settings to an associative array.
     */
    protected function mapSettings()
    {
        $settings = $this->getSettings();

        $this->settingsMap = array();

        foreach ($settings as $setting) {
            $this->settingsMap[$setting->getKey()] = $setting->getValue();
        }
    }
}
