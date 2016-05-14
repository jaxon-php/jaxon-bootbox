<?php

namespace Xajax\Bootbox;

class Bootbox extends \Xajax\Plugin\Response
{
	use \Xajax\Utils\ContainerTrait;

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
		if(!$this->getOption('assets.include.all') && !$this->getOption('assets.include.bootbox'))
		{
			return '';
		}
 		return  '<script type="text/javascript" src="//assets.lagdo-software.net/libs/bootbox/4.3.0/bootbox.min.js"></script>';
 	}

	public function getScript()
	{
		return '
xajax.command.handler.register("bootbox", function(args) {
	bootbox.alert(args.data.content);
});
';
	}

	protected function alert($title, $content, $class)
	{
		$content = '
		<div class="alert alert-' . $class . '" style="margin-top:15px;margin-bottom:-15px;">
			<strong>' . $title . '</strong>
			' . $content . '
		</div>
';
		$this->addCommand(array('cmd'=>'bootbox'), array('content' => $content));
	}

	public function success($title, $content)
	{
		$this->alert($title, $content, 'success');
	}

	public function info($title, $content)
	{
		$this->alert($title, $content, 'info');
	}

	public function warning($title, $content)
	{
		$this->alert($title, $content, 'warning');
	}

	public function error($title, $content)
	{
		$this->alert($title, $content, 'danger');
	}
}
