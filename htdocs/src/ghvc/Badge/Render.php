<?php

namespace Ghvc\Badge;

use PUGX\Poser\Badge;
use PUGX\Poser\Poser;
use PUGX\Poser\Render\SvgFlatRender;
use PUGX\Poser\Render\SvgFlatSquareRender;
use PUGX\Poser\Render\SvgForTheBadgeRenderer;
use PUGX\Poser\Render\SvgPlasticRender;
use Ghvc\Data\BadgeData;

class Render {

    protected $poser;

    protected $data;

    public function __construct(){
        $this->poser = new Poser([
            new SvgPlasticRender(),
            new SvgFlatRender(),
            new SvgFlatSquareRender(),
            new SvgForTheBadgeRenderer()
        ]);
        $this->data = new BadgeData();
    }

    public function getBadge(){

        $label = $_GET['label'] ?? "Profile Views";
        $badgeMessageBackgroundFill = $_GET['color'] ?? 'orange';
        $badgeStyle = $_GET['style'] ?? 'for-the-badge';
        $count = $this->getCount();

        return $this->poser->generate($label, $count, $badgeMessageBackgroundFill, $badgeStyle, Badge::DEFAULT_FORMAT);
    }

    public function getCount(){
        return $this->data->getCountByUsername();
    }
}