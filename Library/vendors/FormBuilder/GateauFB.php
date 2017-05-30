<?php
namespace FormBuilder;

use OCFram\Entity;
use OCFram\PDOFactory;
use Model\CategorieManagerPDO;
use Model\PromoManagerPDO;

use OCFram\FormBuilder;
use OCFram\MaxLengthValidator;
use OCFram\MinLengthValidator;
use OCFram\NotNullValidator;
use OCFram\RuleValidator;
use OCFram\StringField;
use OCFram\HiddenField;
use OCFram\UploadField;
use OCFram\TextField;
use OCFram\ChoiceField;


class GateauFB extends FormBuilder
{
    protected   $categoriesList,
                $categoriesSelected = array(),
                $promotionsList,
                $promotionsSelected = array();

    public function __construct(Entity $entity)
    {
        parent::__construct($entity);

        $db = PDOFactory::getMysqlConnexion();

        $categories = (new CategorieManagerPDO($db))->getList();
        foreach ($categories as $categorie) {
            $this->categoriesList[$categorie->id_categorie] = $categorie->nom;
        }
        if ($this->form->entity()->getId()) {
            $this->categoriesSelected = array($this->form->entity()->getId(), '');
        }

        $promotions = (new PromoManagerPDO($db))->getList();
        foreach ($promotions as $promotion) {
            $this->promotionsList[$promotion->id_promo] = $promotion->code_promo. ' - ' .$promotion->reduction. ' €';
        }
        if ($this->form->entity()->getId()) {
            $this->promotionsSelected = array($this->form->entity()->getId(), '');
        }
    }

    public function build()
    {
        $this->form->add(new HiddenField([
            'label' => '',
            'name' => 'id',
            'value' => '',
        ]))
        ->add(new StringField([
            'label' => 'Nom',
            'name' => 'nom',
            'maxLength' => 50,
            'validators' => [
                new NotNullValidator('Merci de renseigner le nom.'),
                new MaxLengthValidator('Le nom est trop long (50 caractères maximum)', 50),
                new MinLengthValidator('Le nom est trop court (5 caractères minimum)', 5),
                new RuleValidator('Accents, apostrophe, espace et tiret autorisés.', self::RULE_NOM),
            ],
        ]))
        ->add(new StringField([
            'label' => 'Prix',
            'name' => 'prix',
            'maxLength' => 3,
            'validators' => [
                new NotNullValidator('Merci de renseigner le prix.'),
                new MaxLengthValidator('Le prix est trop long (3 caractères maximum)', 3),
                new MinLengthValidator('Le prix est trop court (1 caractères minimum)', 1),
                new RuleValidator('Uniquement chiffres autorisés.', self::RULE_PRIX),
            ],
        ]))
        ->add(new TextField([
            'label' => 'Description',
            'name' => 'description',
            'rows' => 4,
            'cols' => 50,
            'validators' => [
                new NotNullValidator('Merci de renseigner une description'),
            ],
        ]))
        ->add(new UploadField([
            'label' => 'Photo',
            'name' => 'photo',
        ]))
        ->add(new ChoiceField([
            'label' => 'Categorie',
            'name' => 'idCategorie',
            'multiple' => false,
            'optionsSelected' => $this->categoriesSelected,
            'options' => $this->categoriesList,
        ]))
        ->add(new ChoiceField([
            'label' => 'Promotion',
            'name' => 'idPromo',
            'multiple' => false,
            'optionsSelected' => $this->promotionsSelected,
            'options' => $this->promotionsList,
        ]));
    }
}