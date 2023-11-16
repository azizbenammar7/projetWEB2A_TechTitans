<?php
class Fichepatient
{
    private ?int $id = null;
    private ?string $nom = null;
    private ?string $prenom = null;
    private ?int $type_de_diabete = null;
    private ?int $valeur_hemoglobine_A1C = null;
    private ?int $valeur_glycemie_postprondiale = null;
    private ?int $valeur_creatinine_serique = null;
    private ?int $valeur_glycemie_a_jeun = null;
    private ?int $valeur_cholesterol = null;
    private ?int $valeur_hdl = null;
    private ?int $valeur_ldl = null;
    private ?int $valeur_trigleceride = null;
    private ?string $date_d_ajout_d_analyse = null;
    public function __construct($id = null, $n, $p, $t, $h,$g, $c, $j, $ch,$hdl, $ldl, $tr, $da = null)
    {
        $this->id = $id;
        $this->nom = $n;
        $this->prenom = $p;
        $this->type_de_diabete = $t;
        $this->valeur_hemoglobine_A1C = $h;
        $this->valeur_glycemie_postprondiale = $g;
        $this->valeur_creatinine_serique = $c;
        $this->valeur_glycemie_a_jeun = $j;
        $this->valeur_cholesterol = $ch;
        $this->valeur_hdl = $hdl;
        $this->valeur_ldl = $ldl;
        $this->valeur_trigleceride = $tr;
        $this->date_d_ajout_d_analyse = $da;
    }


    public function getId()
    {
        return $this->id;
    }


    public function getNom()
    {
        return $this->nom;
    }


    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }


    public function getPrenom()
    {
        return $this->prenom;
    }


    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }


    public function getType_de_diabete()
    {
        return $this->type_de_diabete;
    }


    public function setType_de_diabete($type_de_diabete)
    {
        $this->type_de_diabete = $type_de_diabete;

        return $this;
    }


    public function getValeur_hemoglobine_A1C()
    {
        return $this->valeur_hemoglobine_A1C;
    }


    public function setValeur_hemoglobine_A1C($valeur_hemoglobine_A1C)
    {
        $this->valeur_hemoglobine_A1C = $valeur_hemoglobine_A1C;

        return $this;
    }
    public function getValeur_glycemie_postprondiale()
    {
        return $this->valeur_glycemie_postprondiale;
    }


    public function setValeur_glycemie_postprondiale($valeur_glycemie_postprondiale)
    {
        $this->valeur_glycemie_postprondiale = $valeur_glycemie_postprondiale;

        return $this;
    }
    public function getValeur_creatinine_serique()
    {
        return $this->valeur_creatinine_serique;
    }


    public function setValeur_creatinine_serique($valeur_creatinine_serique)
    {
        $this->valeur_creatinine_serique = $valeur_creatinine_serique;

        return $this;
    }
    public function getValeur_glycemie_a_jeun()
    {
        return $this->valeur_hemoglobine_A1C;
    }


    public function setValeur_glycemie_a_jeun($valeur_glycemie_a_jeun)
    {
        $this->valeur_glycemie_a_jeun = $valeur_glycemie_a_jeun;

        return $this;
    }
    public function getvaleur_cholesterol()
    {
        return $this->valeur_cholesterol;
    }


    public function setvaleur_cholesterol($valeur_cholesterol)
    {
        $this->valeur_cholesterol = $valeur_cholesterol;

        return $this;
    }
    public function getValeur_hdl()
    {
        return $this->valeur_hdl;
    }


    public function setValeur_hdl($valeur_hdl)
    {
        $this->valeur_hdl = $valeur_hdl;

        return $this;
    }
    public function getValeur_ldl()
    {
        return $this->valeur_ldl;
    }


    public function setValeur_ldl($valeur_ldl)
    {
        $this->valeur_ldl = $valeur_ldl;

        return $this;
    }
    public function getValeur_trigleceride()
    {
        return $this->valeur_trigleceride;
    }


    public function setValeur_trigleceride($valeur_trigleceride)
    {
        $this->valeur_trigleceride = $valeur_trigleceride;

        return $this;
    }
    public function getDate_d_ajout_d_analyse()
    {
        return $this->date_d_ajout_d_analyse;
    }


    public function setDate_d_ajout_d_analyse($date_d_ajout_d_analyse)
    {
        $this->date_d_ajout_d_analyse = $date_d_ajout_d_analyse;

        return $this;
    }
}
