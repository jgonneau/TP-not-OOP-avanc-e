# TP noté OOP avancé

###### Requirements :

Docker<br>
Docker-compose<br>

###### How to start (for the choosen directory 'bon_code' or 'mauvais_code'):

```
cp .env.dist .env

docker-compose up -d
docker-compose exec web composer install
```

Open a web-browser and type 'localhost'. (Make sure there is nothing listening on port *80 to avoid conflits)


## Q/A

######L'injection de dépendence
```
L'injection de dépendance est le fait de passer en paramètre un variable ou objet à une method d'une classe,
de telle manière qu'elle oblige cette variable ou objet d'etre créée ailleurs que dans la classe

Exemple:

class Hero {

    private $weapon = "";

    public equip(Weapon $new_weapon)
    {
        $this->weapon = $new_weapon;
    }
}

Permettant ainsi de mieux gérer les erreurs en externalisant la creation du new_weapon au lieu de la creer dans la methode equip()

```

######Le design pattern observer
```
Le design pattern observer est le fait que le changement d'un état d'objet influe sur les dépendances d'objets dont ceux-ci sont dépendants

Exemple nul:

$hero = new Hero();
$weapon = new Weapon("BreakableBeautifulSword");

$hero->equip($weapon);

$hero->showWeaponState();    ///Ici on observe par exemple la durabilité de l'arme à 10

$hero->attackMonster();   ///Ici l'arme étant utilisé perd de sa durabilité ( -3 )

$hero->showWeaponState();  ///Ici on observe du coup la perte de la durabilité de l'arme à 7

```

######Le temporal couplin 
```
Le temporal couplin est le fait de devoir executer des methodes dans une certaine suite, pour ne pas provoquer de levées d'exeptions (erreurs).

Exemple: 

$hero = new Hero();

$hero->equip("BeautifulSword"); ///Ligne importante car arme pourrait etre non défini dans le constructeur

$hero->attackMonster();   ///Ici pourrait donc creer une erreur si la gestion d'arme est mal gérée

```
