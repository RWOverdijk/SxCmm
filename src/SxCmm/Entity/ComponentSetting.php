<?php
namespace SxCmm\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *  @ORM\Entity
 *  @ORM\Table(
 *      name="component_setting",
 *      uniqueConstraints={@ORM\UniqueConstraint(name="setting_unique",columns={"component_id", "setting_key"})},
 *      indexes={
 *          @ORM\index(name="key_idx", columns={"setting_key"})
 *      }
 *  )
 */
class ComponentSetting
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
    protected $setting_key;

    /**
     * @ORM\Column(type="text")
     * @var string
     */
    protected $setting_value;

    /**
     * @ORM\ManyToOne(targetEntity="Component", inversedBy="settings")
     * @var Component
     */
    protected $component;

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
    public function getKey()
    {
        return $this->setting_key;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->setting_value;
    }

    /**
     * @return Component
     */
    public function getComponent()
    {
        return $this->component;
    }
}
