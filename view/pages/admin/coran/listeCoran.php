<!DOCTYPE html>
<html lang="en">
<?php require_once("../../../sections/admin/head.php"); ?>

<body>
    <div class="container-scroller">
        <?php require_once("../../../sections/admin/navbar.php"); ?>
        <!-- partial:partials/_sidebar.html -->
        <?php require_once("../../../sections/admin/sidebar.php"); ?>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">

            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="page-header">
                        <h3 class="page-title"> Coran disponibles </h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><span class="mdi mdi-plus">Ajouter</span></a></li>
                                <li class="breadcrumb-item active" aria-current="page"><span class="mdi mdi-delete-empty">Corbeille</span></li>
                            </ol>
                        </nav>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Listes Xassida PDF</h4>
                                    <p class="card-description"> Xassida <code>.table</code>
                                    </p>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Titre</th>
                                                    <th>Type</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>53275532</td>
                                                    <td>Coran1</td>
                                                    <td><label class="badge badge-warning">Hafs</label></td>
                                                </tr>
                                                <tr>
                                                    <td>53275533</td>
                                                    <td>Coran2</td>
                                                    <td><label class="badge badge-warning">Hafs</label></td>
                                                </tr>
                                                <tr>
                                                    <td>53275534</td>
                                                    <td>Coran3</td>
                                                    <td><label class="badge badge-success">Warsh</label></td>
                                                </tr>
                                                <tr>
                                                    <td>53275531</td>
                                                    <td>Bindoum Serigne Hamidou Mbacke</td>
                                                    <td><label class="badge badge-success">Warsh</label></td>
                                                </tr>
                                                <tr>
                                                    <td>53275535</td>
                                                    <td>Bindou Serigne Shonhibou Mbacke</td>
                                                    <td><label class="badge badge-success">Warsh</label></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:../../partials/_footer.html -->
                
                <!-- partial -->
            </div>
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="page-header">
                        <h3 class="page-title">Sourates disponibles</h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><span class="mdi mdi-plus">Ajouter</span></a></li>
                                <li class="breadcrumb-item active" aria-current="page"><span class="mdi mdi-delete-empty">Corbeille</span></li>
                            </ol>
                        </nav>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Liste des Sourates</h4>
                                    <p class="card-description">Sourates <code>.table</code></p>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Titre</th>
                                                    <th>Traduction</th>
                                                    <th>Juz</th>
                                                    <th>Versets</th>
                                                    <th>Révélation</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>001</td>
                                                    <td>Al-Fatiha</td>
                                                    <td>L'Ouverture</td>
                                                    <td>1</td>
                                                    <td>7</td>
                                                    <td><label class="badge badge-info">Mecquoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>002</td>
                                                    <td>Al-Baqara</td>
                                                    <td>La Vache</td>
                                                    <td>1</td>
                                                    <td>286</td>
                                                    <td><label class="badge badge-primary">Médinoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>003</td>
                                                    <td>Al-Imran</td>
                                                    <td>La Famille d'Imran</td>
                                                    <td>3</td>
                                                    <td>200</td>
                                                    <td><label class="badge badge-primary">Médinoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>004</td>
                                                    <td>An-Nisa</td>
                                                    <td>Les Femmes</td>
                                                    <td>4</td>
                                                    <td>176</td>
                                                    <td><label class="badge badge-primary">Médinoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>005</td>
                                                    <td>Al-Maida</td>
                                                    <td>La Table Servie</td>
                                                    <td>6</td>
                                                    <td>120</td>
                                                    <td><label class="badge badge-primary">Médinoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>006</td>
                                                    <td>Al-Anam</td>
                                                    <td>Les Bestiaux</td>
                                                    <td>7</td>
                                                    <td>165</td>
                                                    <td><label class="badge badge-info">Mecquoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>007</td>
                                                    <td>Al-Araf</td>
                                                    <td>Le Lieu Élevé</td>
                                                    <td>8</td>
                                                    <td>206</td>
                                                    <td><label class="badge badge-info">Mecquoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>008</td>
                                                    <td>Al-Anfal</td>
                                                    <td>Le Butin</td>
                                                    <td>9</td>
                                                    <td>75</td>
                                                    <td><label class="badge badge-primary">Médinoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>009</td>
                                                    <td>At-Tawba</td>
                                                    <td>Le Repentir</td>
                                                    <td>10</td>
                                                    <td>129</td>
                                                    <td><label class="badge badge-primary">Médinoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>010</td>
                                                    <td>Yunus</td>
                                                    <td>Jonas</td>
                                                    <td>11</td>
                                                    <td>109</td>
                                                    <td><label class="badge badge-info">Mecquoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>011</td>
                                                    <td>Hud</td>
                                                    <td>Hud</td>
                                                    <td>11</td>
                                                    <td>123</td>
                                                    <td><label class="badge badge-info">Mecquoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>012</td>
                                                    <td>Yusuf</td>
                                                    <td>Joseph</td>
                                                    <td>12</td>
                                                    <td>111</td>
                                                    <td><label class="badge badge-info">Mecquoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>013</td>
                                                    <td>Ar-Rad</td>
                                                    <td>Le Tonnerre</td>
                                                    <td>13</td>
                                                    <td>43</td>
                                                    <td><label class="badge badge-primary">Médinoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>014</td>
                                                    <td>Ibrahim</td>
                                                    <td>Abraham</td>
                                                    <td>13</td>
                                                    <td>52</td>
                                                    <td><label class="badge badge-info">Mecquoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>015</td>
                                                    <td>Al-Hijr</td>
                                                    <td>Al-Hijr</td>
                                                    <td>14</td>
                                                    <td>99</td>
                                                    <td><label class="badge badge-info">Mecquoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>016</td>
                                                    <td>An-Nahl</td>
                                                    <td>Les Abeilles</td>
                                                    <td>14</td>
                                                    <td>128</td>
                                                    <td><label class="badge badge-info">Mecquoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>017</td>
                                                    <td>Al-Isra</td>
                                                    <td>Le Voyage Nocturne</td>
                                                    <td>15</td>
                                                    <td>111</td>
                                                    <td><label class="badge badge-info">Mecquoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>018</td>
                                                    <td>Al-Kahf</td>
                                                    <td>La Caverne</td>
                                                    <td>15</td>
                                                    <td>110</td>
                                                    <td><label class="badge badge-info">Mecquoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>019</td>
                                                    <td>Maryam</td>
                                                    <td>Marie</td>
                                                    <td>16</td>
                                                    <td>98</td>
                                                    <td><label class="badge badge-info">Mecquoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>020</td>
                                                    <td>Ta-Ha</td>
                                                    <td>Ta-Ha</td>
                                                    <td>16</td>
                                                    <td>135</td>
                                                    <td><label class="badge badge-info">Mecquoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>021</td>
                                                    <td>Al-Anbiya</td>
                                                    <td>Les Prophètes</td>
                                                    <td>17</td>
                                                    <td>112</td>
                                                    <td><label class="badge badge-info">Mecquoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>022</td>
                                                    <td>Al-Hajj</td>
                                                    <td>Le Pèlerinage</td>
                                                    <td>17</td>
                                                    <td>78</td>
                                                    <td><label class="badge badge-primary">Médinoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>023</td>
                                                    <td>Al-Muminun</td>
                                                    <td>Les Croyants</td>
                                                    <td>18</td>
                                                    <td>118</td>
                                                    <td><label class="badge badge-info">Mecquoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>024</td>
                                                    <td>An-Nur</td>
                                                    <td>La Lumière</td>
                                                    <td>18</td>
                                                    <td>64</td>
                                                    <td><label class="badge badge-primary">Médinoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>025</td>
                                                    <td>Al-Furqan</td>
                                                    <td>Le Discernement</td>
                                                    <td>18</td>
                                                    <td>77</td>
                                                    <td><label class="badge badge-info">Mecquoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>026</td>
                                                    <td>Ash-Shuara</td>
                                                    <td>Les Poètes</td>
                                                    <td>19</td>
                                                    <td>227</td>
                                                    <td><label class="badge badge-info">Mecquoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>027</td>
                                                    <td>An-Naml</td>
                                                    <td>Les Fourmis</td>
                                                    <td>19</td>
                                                    <td>93</td>
                                                    <td><label class="badge badge-info">Mecquoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>028</td>
                                                    <td>Al-Qasas</td>
                                                    <td>Le Récit</td>
                                                    <td>20</td>
                                                    <td>88</td>
                                                    <td><label class="badge badge-info">Mecquoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>029</td>
                                                    <td>Al-Ankabut</td>
                                                    <td>L'Araignée</td>
                                                    <td>20</td>
                                                    <td>69</td>
                                                    <td><label class="badge badge-info">Mecquoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>030</td>
                                                    <td>Ar-Rum</td>
                                                    <td>Les Byzantins</td>
                                                    <td>21</td>
                                                    <td>60</td>
                                                    <td><label class="badge badge-info">Mecquoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>031</td>
                                                    <td>Luqman</td>
                                                    <td>Luqman</td>
                                                    <td>21</td>
                                                    <td>34</td>
                                                    <td><label class="badge badge-info">Mecquoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>032</td>
                                                    <td>As-Sajda</td>
                                                    <td>La Prosternation</td>
                                                    <td>21</td>
                                                    <td>30</td>
                                                    <td><label class="badge badge-info">Mecquoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>033</td>
                                                    <td>Al-Ahzab</td>
                                                    <td>Les Coalisés</td>
                                                    <td>21</td>
                                                    <td>73</td>
                                                    <td><label class="badge badge-primary">Médinoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>034</td>
                                                    <td>Saba</td>
                                                    <td>Saba</td>
                                                    <td>22</td>
                                                    <td>54</td>
                                                    <td><label class="badge badge-info">Mecquoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>035</td>
                                                    <td>Fatir</td>
                                                    <td>Le Créateur</td>
                                                    <td>22</td>
                                                    <td>45</td>
                                                    <td><label class="badge badge-info">Mecquoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>036</td>
                                                    <td>Ya-Sin</td>
                                                    <td>Ya-Sin</td>
                                                    <td>22</td>
                                                    <td>83</td>
                                                    <td><label class="badge badge-info">Mecquoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>037</td>
                                                    <td>As-Saffat</td>
                                                    <td>Rangés en Rangs</td>
                                                    <td>23</td>
                                                    <td>182</td>
                                                    <td><label class="badge badge-info">Mecquoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>038</td>
                                                    <td>Sad</td>
                                                    <td>Sad</td>
                                                    <td>23</td>
                                                    <td>88</td>
                                                    <td><label class="badge badge-info">Mecquoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>039</td>
                                                    <td>Az-Zumar</td>
                                                    <td>Les Groupes</td>
                                                    <td>23</td>
                                                    <td>75</td>
                                                    <td><label class="badge badge-info">Mecquoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>040</td>
                                                    <td>Ghafir</td>
                                                    <td>Le Pardonneur</td>
                                                    <td>24</td>
                                                    <td>85</td>
                                                    <td><label class="badge badge-info">Mecquoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>041</td>
                                                    <td>Fussilat</td>
                                                    <td>Expliqués en Détail</td>
                                                    <td>24</td>
                                                    <td>54</td>
                                                    <td><label class="badge badge-info">Mecquoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>042</td>
                                                    <td>Ash-Shura</td>
                                                    <td>La Consultation</td>
                                                    <td>25</td>
                                                    <td>53</td>
                                                    <td><label class="badge badge-info">Mecquoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>043</td>
                                                    <td>Az-Zukhruf</td>
                                                    <td>L'Ornement</td>
                                                    <td>25</td>
                                                    <td>89</td>
                                                    <td><label class="badge badge-info">Mecquoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>044</td>
                                                    <td>Ad-Dukhan</td>
                                                    <td>La Fumée</td>
                                                    <td>25</td>
                                                    <td>59</td>
                                                    <td><label class="badge badge-info">Mecquoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>045</td>
                                                    <td>Al-Jathiya</td>
                                                    <td>L'Agenouillée</td>
                                                    <td>25</td>
                                                    <td>37</td>
                                                    <td><label class="badge badge-info">Mecquoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>046</td>
                                                    <td>Al-Ahqaf</td>
                                                    <td>Les Dunes</td>
                                                    <td>26</td>
                                                    <td>35</td>
                                                    <td><label class="badge badge-info">Mecquoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>047</td>
                                                    <td>Muhammad</td>
                                                    <td>Muhammad</td>
                                                    <td>26</td>
                                                    <td>38</td>
                                                    <td><label class="badge badge-primary">Médinoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>048</td>
                                                    <td>Al-Fath</td>
                                                    <td>La Victoire</td>
                                                    <td>26</td>
                                                    <td>29</td>
                                                    <td><label class="badge badge-primary">Médinoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>049</td>
                                                    <td>Al-Hujurat</td>
                                                    <td>Les Appartements</td>
                                                    <td>26</td>
                                                    <td>18</td>
                                                    <td><label class="badge badge-primary">Médinoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>050</td>
                                                    <td>Qaf</td>
                                                    <td>Qaf</td>
                                                    <td>26</td>
                                                    <td>45</td>
                                                    <td><label class="badge badge-info">Mecquoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>051</td>
                                                    <td>Adh-Dhariyat</td>
                                                    <td>Les Vents Dispersants</td>
                                                    <td>27</td>
                                                    <td>60</td>
                                                    <td><label class="badge badge-info">Mecquoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>052</td>
                                                    <td>At-Tur</td>
                                                    <td>Le Mont</td>
                                                    <td>27</td>
                                                    <td>49</td>
                                                    <td><label class="badge badge-info">Mecquoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>053</td>
                                                    <td>An-Najm</td>
                                                    <td>L'Étoile</td>
                                                    <td>27</td>
                                                    <td>62</td>
                                                    <td><label class="badge badge-info">Mecquoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>054</td>
                                                    <td>Al-Qamar</td>
                                                    <td>La Lune</td>
                                                    <td>27</td>
                                                    <td>55</td>
                                                    <td><label class="badge badge-info">Mecquoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>055</td>
                                                    <td>Ar-Rahman</td>
                                                    <td>Le Tout Miséricordieux</td>
                                                    <td>27</td>
                                                    <td>78</td>
                                                    <td><label class="badge badge-primary">Médinoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>056</td>
                                                    <td>Al-Waqia</td>
                                                    <td>L'Événement</td>
                                                    <td>27</td>
                                                    <td>96</td>
                                                    <td><label class="badge badge-info">Mecquoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>057</td>
                                                    <td>Al-Hadid</td>
                                                    <td>Le Fer</td>
                                                    <td>27</td>
                                                    <td>29</td>
                                                    <td><label class="badge badge-primary">Médinoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>058</td>
                                                    <td>Al-Mujadila</td>
                                                    <td>La Discussion</td>
                                                    <td>28</td>
                                                    <td>22</td>
                                                    <td><label class="badge badge-primary">Médinoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>059</td>
                                                    <td>Al-Hashr</td>
                                                    <td>L'Exode</td>
                                                    <td>28</td>
                                                    <td>24</td>
                                                    <td><label class="badge badge-primary">Médinoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>060</td>
                                                    <td>Al-Mumtahana</td>
                                                    <td>La Femme Éprouvée</td>
                                                    <td>28</td>
                                                    <td>13</td>
                                                    <td><label class="badge badge-primary">Médinoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>061</td>
                                                    <td>As-Saf</td>
                                                    <td>Le Rang</td>
                                                    <td>28</td>
                                                    <td>14</td>
                                                    <td><label class="badge badge-primary">Médinoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>062</td>
                                                    <td>Al-Jumua</td>
                                                    <td>Le Vendredi</td>
                                                    <td>28</td>
                                                    <td>11</td>
                                                    <td><label class="badge badge-primary">Médinoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>063</td>
                                                    <td>Al-Munafiqun</td>
                                                    <td>Les Hypocrites</td>
                                                    <td>28</td>
                                                    <td>11</td>
                                                    <td><label class="badge badge-primary">Médinoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>064</td>
                                                    <td>At-Taghabun</td>
                                                    <td>La Manifestation des Pertes</td>
                                                    <td>28</td>
                                                    <td>18</td>
                                                    <td><label class="badge badge-primary">Médinoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>065</td>
                                                    <td>At-Talaq</td>
                                                    <td>Le Divorce</td>
                                                    <td>28</td>
                                                    <td>12</td>
                                                    <td><label class="badge badge-primary">Médinoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>066</td>
                                                    <td>At-Tahrim</td>
                                                    <td>L'Interdiction</td>
                                                    <td>28</td>
                                                    <td>12</td>
                                                    <td><label class="badge badge-primary">Médinoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>067</td>
                                                    <td>Al-Mulk</td>
                                                    <td>La Royauté</td>
                                                    <td>29</td>
                                                    <td>30</td>
                                                    <td><label class="badge badge-info">Mecquoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>068</td>
                                                    <td>Al-Qalam</td>
                                                    <td>Le Calame</td>
                                                    <td>29</td>
                                                    <td>52</td>
                                                    <td><label class="badge badge-info">Mecquoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>069</td>
                                                    <td>Al-Haqqa</td>
                                                    <td>La Réalité</td>
                                                    <td>29</td>
                                                    <td>52</td>
                                                    <td><label class="badge badge-info">Mecquoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>070</td>
                                                    <td>Al-Maarij</td>
                                                    <td>Les Voies d'Ascension</td>
                                                    <td>29</td>
                                                    <td>44</td>
                                                    <td><label class="badge badge-info">Mecquoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>071</td>
                                                    <td>Nuh</td>
                                                    <td>Noé</td>
                                                    <td>29</td>
                                                    <td>28</td>
                                                    <td><label class="badge badge-info">Mecquoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>072</td>
                                                    <td>Al-Jinn</td>
                                                    <td>Les Djinns</td>
                                                    <td>29</td>
                                                    <td>28</td>
                                                    <td><label class="badge badge-info">Mecquoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>073</td>
                                                    <td>Al-Muzzammil</td>
                                                    <td>L'Enveloppé</td>
                                                    <td>29</td>
                                                    <td>20</td>
                                                    <td><label class="badge badge-info">Mecquoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>074</td>
                                                    <td>Al-Muddaththir</td>
                                                    <td>Le Revêtu</td>
                                                    <td>29</td>
                                                    <td>56</td>
                                                    <td><label class="badge badge-info">Mecquoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>075</td>
                                                    <td>Al-Qiyama</td>
                                                    <td>La Résurrection</td>
                                                    <td>29</td>
                                                    <td>40</td>
                                                    <td><label class="badge badge-info">Mecquoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>076</td>
                                                    <td>Al-Insan</td>
                                                    <td>L'Être Humain</td>
                                                    <td>29</td>
                                                    <td>31</td>
                                                    <td><label class="badge badge-primary">Médinoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>077</td>
                                                    <td>Al-Mursalat</td>
                                                    <td>Les Envoyés</td>
                                                    <td>29</td>
                                                    <td>50</td>
                                                    <td><label class="badge badge-info">Mecquoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>078</td>
                                                    <td>An-Naba</td>
                                                    <td>La Nouvelle</td>
                                                    <td>30</td>
                                                    <td>40</td>
                                                    <td><label class="badge badge-info">Mecquoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>079</td>
                                                    <td>An-Naziat</td>
                                                    <td>Les Arracheurs</td>
                                                    <td>30</td>
                                                    <td>46</td>
                                                    <td><label class="badge badge-info">Mecquoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>080</td>
                                                    <td>Abasa</td>
                                                    <td>Il a Froncé</td>
                                                    <td>30</td>
                                                    <td>42</td>
                                                    <td><label class="badge badge-info">Mecquoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>081</td>
                                                    <td>At-Takwir</td>
                                                    <td>L'Enroulement</td>
                                                    <td>30</td>
                                                    <td>29</td>
                                                    <td><label class="badge badge-info">Mecquoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>082</td>
                                                    <td>Al-Infitar</td>
                                                    <td>Le Déchirement</td>
                                                    <td>30</td>
                                                    <td>19</td>
                                                    <td><label class="badge badge-info">Mecquoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>083</td>
                                                    <td>Al-Mutaffifin</td>
                                                    <td>Les Fraudeurs</td>
                                                    <td>30</td>
                                                    <td>36</td>
                                                    <td><label class="badge badge-info">Mecquoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>084</td>
                                                    <td>Al-Inshiqaq</td>
                                                    <td>Le Déchirement</td>
                                                    <td>30</td>
                                                    <td>25</td>
                                                    <td><label class="badge badge-info">Mecquoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>085</td>
                                                    <td>Al-Buruj</td>
                                                    <td>Les Constellations</td>
                                                    <td>30</td>
                                                    <td>22</td>
                                                    <td><label class="badge badge-info">Mecquoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>086</td>
                                                    <td>At-Tariq</td>
                                                    <td>L'Astre Nocturne</td>
                                                    <td>30</td>
                                                    <td>17</td>
                                                    <td><label class="badge badge-info">Mecquoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>087</td>
                                                    <td>Al-Ala</td>
                                                    <td>Le Très-Haut</td>
                                                    <td>30</td>
                                                    <td>19</td>
                                                    <td><label class="badge badge-info">Mecquoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>088</td>
                                                    <td>Al-Ghashiya</td>
                                                    <td>L'Enveloppante</td>
                                                    <td>30</td>
                                                    <td>26</td>
                                                    <td><label class="badge badge-info">Mecquoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>089</td>
                                                    <td>Al-Fajr</td>
                                                    <td>L'Aube</td>
                                                    <td>30</td>
                                                    <td>30</td>
                                                    <td><label class="badge badge-info">Mecquoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>090</td>
                                                    <td>Al-Balad</td>
                                                    <td>La Cité</td>
                                                    <td>30</td>
                                                    <td>20</td>
                                                    <td><label class="badge badge-info">Mecquoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>091</td>
                                                    <td>Ash-Shams</td>
                                                    <td>Le Soleil</td>
                                                    <td>30</td>
                                                    <td>15</td>
                                                    <td><label class="badge badge-info">Mecquoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>092</td>
                                                    <td>Al-Layl</td>
                                                    <td>La Nuit</td>
                                                    <td>30</td>
                                                    <td>21</td>
                                                    <td><label class="badge badge-info">Mecquoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>093</td>
                                                    <td>Ad-Duha</td>
                                                    <td>Le Matin</td>
                                                    <td>30</td>
                                                    <td>11</td>
                                                    <td><label class="badge badge-info">Mecquoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>094</td>
                                                    <td>Ash-Sharh</td>
                                                    <td>L'Expansion</td>
                                                    <td>30</td>
                                                    <td>8</td>
                                                    <td><label class="badge badge-info">Mecquoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>095</td>
                                                    <td>At-Tin</td>
                                                    <td>Le Figuier</td>
                                                    <td>30</td>
                                                    <td>8</td>
                                                    <td><label class="badge badge-info">Mecquoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>096</td>
                                                    <td>Al-Alaq</td>
                                                    <td>Le Caillot</td>
                                                    <td>30</td>
                                                    <td>19</td>
                                                    <td><label class="badge badge-info">Mecquoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>097</td>
                                                    <td>Al-Qadr</td>
                                                    <td>La Nuit du Destin</td>
                                                    <td>30</td>
                                                    <td>5</td>
                                                    <td><label class="badge badge-info">Mecquoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>098</td>
                                                    <td>Al-Bayyina</td>
                                                    <td>La Preuve</td>
                                                    <td>30</td>
                                                    <td>8</td>
                                                    <td><label class="badge badge-primary">Médinoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>099</td>
                                                    <td>Az-Zalzala</td>
                                                    <td>Le Séisme</td>
                                                    <td>30</td>
                                                    <td>8</td>
                                                    <td><label class="badge badge-primary">Médinoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>100</td>
                                                    <td>Al-Adiyat</td>
                                                    <td>Les Coureurs</td>
                                                    <td>30</td>
                                                    <td>11</td>
                                                    <td><label class="badge badge-info">Mecquoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>101</td>
                                                    <td>Al-Qaria</td>
                                                    <td>Le Fracas</td>
                                                    <td>30</td>
                                                    <td>11</td>
                                                    <td><label class="badge badge-info">Mecquoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>102</td>
                                                    <td>At-Takathur</td>
                                                    <td>La Rivalité</td>
                                                    <td>30</td>
                                                    <td>8</td>
                                                    <td><label class="badge badge-info">Mecquoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>103</td>
                                                    <td>Al-Asr</td>
                                                    <td>Le Temps</td>
                                                    <td>30</td>
                                                    <td>3</td>
                                                    <td><label class="badge badge-info">Mecquoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>104</td>
                                                    <td>Al-Humaza</td>
                                                    <td>Le Calomniateur</td>
                                                    <td>30</td>
                                                    <td>9</td>
                                                    <td><label class="badge badge-info">Mecquoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>105</td>
                                                    <td>Al-Fil</td>
                                                    <td>L'Éléphant</td>
                                                    <td>30</td>
                                                    <td>5</td>
                                                    <td><label class="badge badge-info">Mecquoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>106</td>
                                                    <td>Quraysh</td>
                                                    <td>Les Qurayshites</td>
                                                    <td>30</td>
                                                    <td>4</td>
                                                    <td><label class="badge badge-info">Mecquoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>107</td>
                                                    <td>Al-Maun</td>
                                                    <td>L'Ustensile</td>
                                                    <td>30</td>
                                                    <td>7</td>
                                                    <td><label class="badge badge-info">Mecquoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>108</td>
                                                    <td>Al-Kawthar</td>
                                                    <td>L'Abondance</td>
                                                    <td>30</td>
                                                    <td>3</td>
                                                    <td><label class="badge badge-info">Mecquoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>109</td>
                                                    <td>Al-Kafirun</td>
                                                    <td>Les Mécréants</td>
                                                    <td>30</td>
                                                    <td>6</td>
                                                    <td><label class="badge badge-info">Mecquoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>110</td>
                                                    <td>An-Nasr</td>
                                                    <td>Le Secours</td>
                                                    <td>30</td>
                                                    <td>3</td>
                                                    <td><label class="badge badge-primary">Médinoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>111</td>
                                                    <td>Al-Masad</td>
                                                    <td>Les Fibres</td>
                                                    <td>30</td>
                                                    <td>5</td>
                                                    <td><label class="badge badge-info">Mecquoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>112</td>
                                                    <td>Al-Ikhlas</td>
                                                    <td>Le Monothéisme Pur</td>
                                                    <td>30</td>
                                                    <td>4</td>
                                                    <td><label class="badge badge-info">Mecquoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>113</td>
                                                    <td>Al-Falaq</td>
                                                    <td>L'Aube Naissante</td>
                                                    <td>30</td>
                                                    <td>5</td>
                                                    <td><label class="badge badge-info">Mecquoise</label></td>
                                                </tr>
                                                <tr>
                                                    <td>114</td>
                                                    <td>An-Nas</td>
                                                    <td>Les Hommes</td>
                                                    <td>30</td>
                                                    <td>6</td>
                                                    <td><label class="badge badge-info">Mecquoise</label></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2024 <a href="https://www.bootstrapdash.com/" target="_blank">BootstrapDash</a>. All rights reserved.</span>
                        <span class="text-muted float-none float-sm-end d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="mdi mdi-heart text-danger"></i></span>
                    </div>
                </footer>
            </div>
            <!-- main-panel ends -->
             
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <?php require_once("../../../sections/admin/script.php"); ?>
    <!-- End custom js for this page -->
</body>

</html>