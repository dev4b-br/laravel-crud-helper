<?php

namespace Dev4b\LaravelCrudHelper\Forms;

use Dev4b\LaravelCrudHelper\Concerns\Content;
use Dev4b\LaravelCrudHelper\Inputs\AbstractInput;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

abstract class AbstractForm
{
    protected array $inputs = [];

    protected ?string $parentView = null;

    protected string $title = '';

    protected string $id;

    protected bool $isAjax = false;

    public function __construct(?string $parentView = null)
    {
        $this->parentView = $parentView;
        $this->setup();
    }

    abstract protected function setup();

    public function view(): View
    {
        $view = 'laravel-crud-helper::form';

        if (!$this->parentView) {
            $view = 'laravel-crud-helper::form-standalone';
        }

        return view($view)
            ->with('parentView', $this->parentView)
            ->with('inputs', $this->inputs)
            ->with('action', $this->getAction())
            ->with('submitText', $this->getSubmitText())
            ->with('isAjax', $this->isAjax)
            ->with('formId', uniqid('form-'));
    }

    abstract public function execute(Request $request);

    public function render(): string
    {
        return $this->view()->render();
    }

    public function addInput(AbstractInput $input)
    {
        $this->inputs[] = $input;
    }

    public function addContentBlock(Content $contentBlock)
    {
        $this->inputs[] = $contentBlock;
    }

    public function addLineBreak()
    {
        $this->inputs[] = view('laravel-crud-helper::content-blocks.lineBreak');
    }

    protected function getSubmitText()
    {
        return 'Salvar';
    }

    abstract public function getRedirectRoute();

    abstract protected function getAction(): string;

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }

    /**
     * @param bool $isAjax
     */
    public function setIsAjax(bool $isAjax): void
    {
        $this->isAjax = $isAjax;
    }

    public function getId()
    {
        return $this->id ?: Str::slug($this->title);
    }

}
