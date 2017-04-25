<?php
namespace BetaKiller\Utils\Registry;

trait RegistryTrait
{
    protected $_registry = [];

    /**
     * @param string     $key
     * @param mixed      $object
     * @param bool|FALSE $ignoreDuplicate
     *
     * @return $this
     * @throws Exception
     */
    public function set($key, $object, $ignoreDuplicate = false)
    {
        if (!$ignoreDuplicate && $this->has($key)) {
            throw new Exception('Data for :key key already exists', [':key' => $key]);
        }

        $this->_registry[$key] = $object;

        return $this;
    }

    /**
     * @param string $key
     *
     * @return mixed|null
     */
    public function get($key)
    {
        return $this->has($key)
            ? $this->_registry[$key]
            : null;
    }

    /**
     * @return $this
     */
    public function clear()
    {
        $this->_registry = [];

        return $this;
    }

    /**
     * @return array
     */
    public function getAll()
    {
        return $this->_registry;
    }

    /**
     * @param string $key
     *
     * @return bool
     */
    public function has($key)
    {
        return (isset($this->_registry[$key]));
    }

    /**
     * Returns keys of currently added items
     *
     * @return array
     */
    public function keys()
    {
        return array_keys($this->_registry);
    }

    /**
     * @param $key
     *
     * @return bool
     * @deprecated
     */
    public function __isset($key)
    {
        return $this->has($key);
    }

    /**
     * @param $key
     *
     * @return null
     * @deprecated
     */
    public function __get($key)
    {
        return $this->get($key);
    }

    /**
     * @param $key
     * @param $object
     *
     * @deprecated
     * @throws Exception
     */
    public function __set($key, $object)
    {
        $this->set($key, $object);
    }
}