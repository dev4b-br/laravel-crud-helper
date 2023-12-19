<?php

namespace Dev4b\LaravelCrudHelper\Forms;

use Dev4b\LaravelCrudHelper\Concerns\Content;
use Dev4b\LaravelCrudHelper\ContentBlocks\Collapse;
use Dev4b\LaravelCrudHelper\ContentBlocks\ContentGroup;
use Dev4b\LaravelCrudHelper\ContentBlocks\Dropdown;
use Dev4b\LaravelCrudHelper\Inputs\AbstractInput;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

abstract class AbstractForm
{
    protected array $inputs = [];

    protected ?string $parentView = null;

    protected string $title = '';

    protected string $id;

    public bool $isAjax = false;

    protected ?string $enctype = null;

    protected ?string $changeFieldCallbackUrl = null;

    protected bool $showErrorsOnTop = true;

    protected ?Dropdown $dropdown = null;

    protected bool $renderSubmitButton = true;

    protected $breadcrumbs = '';

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
            ->with('breadcrumbs', $this->breadcrumbs)
            ->with('parentView', $this->parentView)
            ->with('inputs', $this->inputs)
            ->with('action', $this->getAction())
            ->with('submitText', $this->getSubmitText())
            ->with('isAjax', $this->isAjax)
            ->with('formId', uniqid('form-'))
            ->with('enctype', $this->enctype)
            ->with('changeFieldCallbackUrl', $this->changeFieldCallbackUrl)
            ->with('inputsWithRefreshList', $this->getInputsWithRefreshList())
            ->with('showErrorsOnTop', $this->showErrorsOnTop)
            ->with('dropdown', $this->dropdown)
            ->with('renderSubmitButton', $this->renderSubmitButton);
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

    public function addContentBlock(Renderable $contentBlock)
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

    public function setParentView(?string $parentView): void
    {
        $this->parentView = $parentView;
    }

    public function setCallbackUrl(string $changeFieldCallbackUrl): void
    {
        $this->changeFieldCallbackUrl = $changeFieldCallbackUrl;
    }

    public function setDropdown(Dropdown $dropdown): void
    {
        $this->dropdown = $dropdown;
    }

    private function getInputsWithRefreshList()
    {
        $inputs = [];

        foreach ($this->getAllInputs($this->inputs) as $input) {
            if ($input instanceof AbstractInput && $input->getRefreshList()) {
                $inputs[] = $input;
            }
        }

        return $inputs;
    }

    private function getAllInputs($inputs)
    {
        $returnData = [];

        foreach ($inputs as $component) {
            if ($component instanceof Collapse && $component->getContent() instanceof ContentGroup) {
                $returnData = array_merge($returnData, $this->getAllInputs($component->getContent()->getItems()));
            } else {
                $returnData[] = $component;
            }
        }

        return $returnData;
    }

    protected function disableSubmitButton()
    {
        $this->renderSubmitButton = false;
    }
}
