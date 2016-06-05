<?php

namespace Jaxon\Bootbox;

class Bootbox extends \Jaxon\Plugin\Response
{
    use \Jaxon\Utils\ContainerTrait;

    public function getName()
    {
        return 'bootbox';
    }

    public function generateHash()
    {
        // The version number is used as hash
        return '1.0.0';
    }

    public function getJs()
     {
        if(!$this->includeAssets())
        {
            return '';
        }
         return  '<script type="text/javascript" src="//assets.lagdo-software.net/libs/bootbox/4.3.0/bootbox.min.js"></script>';
     }

    public function getScript()
    {
        return '
jaxon.command.handler.register("bootbox", function(args) {
    bootbox.alert(args.data.content);
});
';
    }

    protected function alert($message, $title, $class)
    {
        $content = '
        <div class="alert alert-' . $class . '" style="margin-top:15px;margin-bottom:-15px;">
';
        if(($title))
        {
            $content .= '
            <strong>' . $title . '</strong>
';
        }
        $content .= '
            ' . $message . '
        </div>
';
        $this->addCommand(array('cmd' => 'bootbox'), array('content' => $content));
    }

    public function success($message, $title = null)
    {
        $this->alert($message, $title, 'success');
    }

    public function info($message, $title = null)
    {
        $this->alert($message, $title, 'info');
    }

    public function warning($message, $title = null)
    {
        $this->alert($message, $title, 'warning');
    }

    public function error($message, $title = null)
    {
        $this->alert($message, $title, 'danger');
    }
}
