<html>
    <head>
        <title> </title>
    </head>
    <body>
    <center>

            <?php
                try
                {
                    $bdd = new PDO('mysql:host=localhost;dbname=pierres_db2;charset=utf8', 'psaulay', '******');
                }
                catch (Exception $e)
                {
                die('Erreur : ' . $e->getMessage());
                }

                echo '<h2>Exercice 1</h2>';
                $reponse = $bdd->prepare('SELECT * FROM BDD WHERE last_name = ?');
                $reponse->execute(['palmer']);
                $results = $reponse->fetchAll();

                foreach ($results as $result){
                    echo '<p>'.$result['first_name'].' | '.$result['last_name'].' | '.$result['email'].' | '.$result['gender'].' | '.$result['ip_address'].' | '.$result['birth_date'].' | '.$result['country_code'].'</p>';
                }

                echo '<h2>Exercice 2</h2>';

                $reponse = $bdd->prepare('SELECT * FROM BDD WHERE gender = ?');
                $reponse->execute(['Female']);
                $results = $reponse->fetchAll();

                foreach ($results as $result){

                    echo '<p>'.$result['first_name'].' | '.$result['last_name'].' | '.$result['email'].' | '.$result['gender'].' | '.$result['ip_address'].' | '.$result['birth_date'].' | '.$result['country_code'].'</p>';

                }

                echo '<h2>Exercice 3</h2>';

                $reponse = $bdd->prepare('SELECT * FROM BDD WHERE country_code LIKE ?');
                $reponse->execute(['N%']);
                $results = $reponse->fetchAll();

                foreach ($results as $result){


                    echo '<p>'.$result['first_name'].' | '.$result['last_name'].' | '.$result['email'].' | '.$result['gender'].' | '.$result['ip_address'].' | '.$result['birth_date'].' | '.$result['country_code'].'</p>';



                }
                echo '<h2>Exercice 4</h2>';

                $reponse = $bdd->prepare('SELECT * FROM BDD WHERE email LIKE ?');
                $reponse->execute(['%google%']);
                $results = $reponse->fetchAll();

                foreach ($results as $result){

                echo '<p>'.$result['first_name'].' | '.$result['last_name'].' | '.$result['email'].' | '.$result['gender'].' | '.$result['ip_address'].' | '.$result['birth_date'].' | '.$result['country_code'].'</p>';

                }
                echo '<h2>Exercice 5</h2>';

                $reponse = $bdd->prepare('SELECT country_code,COUNT(*) AS country_nb FROM BDD GROUP BY country_code ORDER BY country_nb ASC');
                $reponse->execute(['%']);

                $results = $reponse->fetchAll();

                foreach ($results as $result){
                    echo '<p>'.$result['country_code'].' '.$result['country_nb'].'</p>';

                }
                echo '<h2>Exercice 6</h2>';
                $bdd->exec("INSERT INTO BDD(first_name, last_name, email) VALUES('pierre', 'saulay', 'psaulay@gmail.com')");
                echo 'L\'entrée a bien été ajouté !';
                $bdd->exec('DELETE FROM BDD WHERE email="psaulay@gmail.com"');
                echo 'L\'entré à bien été supprimée';


                echo '<h2>Exercice 7</h2>';
                function x($bdd) {

                $reponse = $bdd->prepare('SELECT gender,COUNT(*) AS gender_nb FROM BDD GROUP BY gender ORDER BY gender_nb ASC');
                $reponse->execute(['%']);

                $results = $reponse->fetchAll();
                $moyenne = [];
                foreach ($results as $result){ 
                    array_push($moyenne, ['gender' => $result['gender'], 'nb' => $result['gender_nb']]);
                }
                return $moyenne;
                }

                $averages = x($bdd);
        
                foreach ($averages as $average){ 
                    echo '<p>'.$average['gender'].' '.$average['nb'].'</p>';
                }

                echo $moyenne;
                echo '<h2>Exercice 8</h2>';

                $reponse = $bdd->prepare('SELECT birth_date, last_name, first_name FROM BDD');
                $reponse->execute(['%']);
                $today = date_create('today') ;
                $results = $reponse->fetchAll();

                    function getAge($result, $today) { 
                        return date_diff(date_create($result), $today)->y;
                    }
                
                foreach ($results as $result){
                    echo '<p>'.$result['last_name'].' '.$result['first_name'].'</p>';
                    echo '<p>'.getAge($result['birth_date'], $today).'</p>';
                    
                    echo '<p>'.$result['birth_date'].'</p>';
                    echo '--------------------------------------------------';

                }
                echo '<h2>Exercice 8 Bis</h2>';

                $request = $bdd->prepare('SELECT birth_date,gender FROM BDD');
                $request->execute();
                $results = $request->fetchAll();

                $moy_men = $moy_women = 0;

                foreach ($results as $result) {

                    $gender = $result['gender'];
                    $age = getAge($result['birth_date'], $today);

                    if($gender === 'Female') {

                        $moy_women += $age;

                    } else {

                        $moy_men += $age;

                    }
                }
                $moy_women /= $averages[0]['nb'];
                $moy_men /= $averages[1]['nb'];

                echo '<p>La moyenne d\'age des femmes est   '.round($moy_women).' ans';
                echo '<p>La moyenne d\'age des hommes est    '.round($moy_men).' ans';
                    

//INSERT INTO students (nom, prenom)
 //VALUES
 //('W******K', 'Arnaud'), 
 //('T******Y', 'Charlotte'),	 
 //('V******D', 'Dorothée'),  
 //('N******S', 'Jonathan'),	 
 //('J******D', 'Maxime'),	 
 //('H******Y', 'Pierre'),	 
 //('S******Y', 'Pierre'),	 
 //('D******N', 'Stacy'),	 
 //('E* Z***I', 'Otmane'),	 
 //('C******Y', 'Raphael'),	 
 //('Y******S', 'Rasha');	
 
//SELECT * FROM students INNER JOIN departements ON students.dpt = departements.dpt;
            ?>
    </center>
    </body>
</html>