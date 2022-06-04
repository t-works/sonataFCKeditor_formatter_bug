<?php

namespace App\Admin;

use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\FormatterBundle\Form\Type\FormatterType;
use Sonata\FormatterBundle\Form\Type\SimpleFormatterType;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ArticleAdmin extends AbstractAdmin implements ContainerAwareInterface
{
    use ContainerAwareTrait;
//
//    public function __construct(string $code, string $class, string $baseControllerName, Container $container)
//    {
//        parent::__construct($code, $class, $baseControllerName);
//        $this->container = $container;
//    }
//    /** @var \Symfony\Component\DependencyInjection\ContainerInterface */
//    private $container;
//

    protected function configureFormFields(FormMapper $form): void
    {
        $form->add('title', TextType::class);
//        $form->add('body', TextareaType::class);
//        $form->add('shortDescription', 'sonata_formatter_type', [
//        'source_field' => 'rawDescription',
//        'source_field_options' => ['attr' => ['class' => 'span10', 'rows' => 20]],
//        'format_field' => 'descriptionFormatter',
//        'target_field' => 'description',
//        'ckeditor_context' => 'default',
//        'event_dispatcher' => $form->getFormBuilder()->getEventDispatcher()
//    ]);
//        $form->add('body', CKEditorType::Class,[
//            'config' => [
//                'toolbar' => [
//                    [
//                        'name' => 'links',
//                        'items' => ['Link', 'Unlink'],
//                    ],
//                    [
//                        'name' => 'insert',
//                        'items' => ['Image'],
//                    ],
//                ],
//            ],
//        ]);
//        $form->add('body', FormatterType::Class,[
//            'event_dispatcher' => $form->getFormBuilder()->getEventDispatcher(),
//            'format_field'   => 'contentFormatter',
//            'format_field_options' => [
//                'choices' => [
//                    'text' => 'Text',
//                    'markdown' => 'Markdown',
//                ],
//                'data' => 'markdown',
//            ],
//            'source_field' => 'rawContent',
//            'source_field_options' => [
//                'attr' => ['class' => 'span10', 'rows' => 20],
//            ],
//            'listener' => true,
//            'target_field' => 'content',
//        ]);
//        $form->add('body', FormatterType::Class,[
//            'source_field' => 'rawDescription',
//            'source_field_options' => ['attr' => ['class' => 'span10', 'rows' => 20]],
//            'format_field' => 'body',
//            'target_field' => 'description',
//            'ckeditor_context' => 'default',
//            'event_dispatcher' => $form->getFormBuilder()->getEventDispatcher(),
//        ]);
        $form->add('body', SimpleFormatterType::Class,[
            'format' => 'richhtml',
            'ckeditor_context' => 'default',
            'ckeditor_toolbar_icons'=>[
                    [
                        'name' => 'links',
                        'items' => ['Link', 'Unlink'],
                    ],
                    [
                        'name' => 'insert',
                        'items' => ['Image'],
                    ],
                ],
//            'event_dispatcher' => $form->getFormBuilder()->getEventDispatcher()
        ]);
    }

    protected function configureDatagridFilters(DatagridMapper $datagrid): void
    {
        $datagrid->add('title');
        $datagrid->add('created');
        $datagrid->add('updated');
    }
//    public function getContainer(){
//        return $this->getConfigurationPool()->getContainer();
//    }
    protected function configureListFields(ListMapper $list): void
    {
        $list->addIdentifier('title');
        $list->add('created');
        $list->add('updated');
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show->add('title');
        $show->add('body');
    }
}
