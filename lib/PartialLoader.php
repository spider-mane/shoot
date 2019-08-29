<?php

namespace WebTheory;

/**
 *
 */
class PartialLoader
{
    /**
     * templates
     *
     * @var array
     */
    protected $templates = [];

    /**
     * template_args
     *
     * @var array
     */
    protected $template_args = [];

    /**
     *
     */
    protected static $partials = ['header', 'footer', 'sidebar', 'navbar'];

    /**
     *
     */
    private static $_partials = ['header', 'footer', 'sidebar'];

    /**
     *
     */
    protected function __construct($arg_names, $template_args)
    {
        foreach ((array) $arg_names as $i => $key) {
            $this->template_args[$key] = $template_args[$i];
        }
    }

    /**
     *
     */
    public static function __callStatic($template, $args)
    {
        if (in_array($template, static::$partials)) {
            $name = $args[0];
            $arg_names = $args[1];
            $args = array_slice($args, 2);

            return static::template($template, $name, $arg_names, ...$args);
        }
    }

    /**
     *
     */
    public static function template($template, $name = null, $arg_names = null, ...$args)
    {
        if (in_array($template, static::$partials)) {
            return (new static($arg_names, $args))->_template($template, $name);
        }
    }

    /**
     * replaces get_template_part
     */
    public static function partial($slug, $name = null, $arg_names = null, ...$args)
    {
        return (new static($arg_names, $args))->_partial($slug, $name);
    }

    /**
     *
     */
    protected function _template($template, $name = null)
    {
        /**
         * allows loading template partials using this method to be compatable
         * with wordpress counterparts
         *
         * @see https://developer.wordpress.org/reference/hooks/get_header/
         * @see https://developer.wordpress.org/reference/hooks/get_footer/
         * @see https://developer.wordpress.org/reference/hooks/get_sidebar/
         */
        do_action("get_{$template}", $name);

        if (!empty($name)) {
            $this->templates[] = "{$template}-{$name}.php";
        }

        $this->templates[] = "{$template}.php";

        $this->get_template_partial();
    }

    /**
     *
     */
    protected function _partial($slug, $name = null)
    {
        /**
         * @see https://developer.wordpress.org/reference/hooks/get_template_part_slug/
         */
        do_action("get_template_part_{$slug}", $slug, $name);
        do_action("get_template_part", $slug, $name);

        if (!empty($name)) {
            $this->templates[] = "{$slug}-{$name}.php";
        }

        $this->templates[] = "{$slug}.php";

        $this->get_template_partial($arg_names, ...$args);
    }

    /**
     *
     */
    protected function get_template_partial()
    {
        /**
         * create variables for availability in template
         */
        foreach ($this->template_args as $var => $value) {
            $$var = $value;
        }

        include locate_template($this->templates, false);
    }
}
