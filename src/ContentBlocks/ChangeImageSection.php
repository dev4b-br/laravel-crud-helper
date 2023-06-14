<?php

namespace Dev4b\LaravelCrudHelper\ContentBlocks;

use Dev4b\LaravelCrudHelper\Concerns\AbstractBlock;
use Dev4b\LaravelCrudHelper\Concerns\HasHint;
use Dev4b\LaravelCrudHelper\Concerns\HasWidth;

class ChangeImageSection extends AbstractBlock
{
    use HasHint, HasWidth;

    const SMALL = 'w-px-75 h-px-75';
    const MEDIUM = 'w-px-120 h-px-120';
    const LARGE = 'w-px-200 h-px-200';

    protected string $name;

    protected ?string $id;

    protected ?string $placeholderPath;

    protected ?string $mdiIcon = 'tray-arrow-up';

    protected $imageSize = self::SMALL;

    public function __construct(string $name, ?string $id = null, ?string $placeholderPath = '../../assets/img/avatars/1.png')
    {
        $this->name = $name;
        $this->id = $id;
        $this->placeholderPath = $placeholderPath;
    }

    public function setMdiIcon($mdiIcon)
    {
        $this->mdiIcon = $mdiIcon;
    }

    public function setImageSize($imageSize)
    {
        switch (strtoupper($imageSize)) {
            case 'S':
                $this->imageSize = self::SMALL;
                break;
            case 'M':
                $this->imageSize = self::MEDIUM;
                break;
            case 'L':
                $this->imageSize = self::LARGE;
                break;
        }
    }

    public function render()
    {
        $view = view('laravel-crud-helper::content-blocks.changeImageSection');
        $view->with('name', $this->name)
            ->with('id', $this->id)
            ->with('placeholderPath', $this->placeholderPath)
            ->with('hint', $this->hint)
            ->with('mdiIcon', $this->mdiIcon)
            ->with('imageSize', $this->imageSize)
            ->with('containerClasses', $this->containerClasses);

        return $view;
    }
}
