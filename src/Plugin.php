<?php

namespace Jaxon\Bootbox;

class Plugin extends \Jaxon\Plugin\Response
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
        return '<script type="text/javascript" src="//lib.jaxon-php.org/bootbox/4.3.0/bootbox.min.js"></script>';
    }

    protected function getContainer()
    {
        $sContainer = 'bootbox-container';
        if($this->hasOption('bootbox.dom.container'))
        {
            $sContainer = $this->getOption('bootbox.dom.container');
        }
        return $sContainer;
    }

    public function getScript()
    {
        // Modal container
        $sContainer = $this->getContainer();

        return '
if(!$("#' . $sContainer . '").length)
{
    $("body").append("<div id=\"' . $sContainer . '\"></div>");
}
jaxon.command.handler.register("bootbox", function(args) {
    bootbox.alert(args.data.content);
});
';
    }

    public function modal($title, $content, $buttons, $width = 600)
    {
        // Modal container
        $sContainer = $this->getContainer();

        // Buttons
        $buttonsHtml = '
';
        foreach($buttons as $button)
        {
            if($button['click'] == 'close')
            {
                $buttonsHtml .= '
            <button type="button" class="' . $button['class'] . '" data-dismiss="modal">' . $button['title'] . '</button>';
            }
            else
            {
                $buttonsHtml .= '
            <button type="button" class="' . $button['class'] . '" onclick="' . $button['click'] . '">' . $button['title'] . '</button>';
            }
        }
        // Dialog
        $dialogHtml = '
    <div id="styledModal" class="modal modal-styled">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 class="modal-title">' . $title . '</h3>
                </div>
                <div class="modal-body">
' . $content . '
                </div>
                <div class="modal-footer">' . $buttonsHtml . '
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
';
        // Assign dialog content
        $this->response()->assign($sContainer, 'innerHTML', $dialogHtml);
        $this->response()->script("$('.modal-dialog').css('width', '{$width}px')");
        $this->response()->script("$('#styledModal').modal('show')");
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
