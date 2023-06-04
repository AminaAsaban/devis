
<?php 
include('include/headlinks.php') ;
include('include/sidebar.inc.php') ;
include('include/navbar.php') ;
include_once('include/database.php');

?>
<title>Devis</title>
<div class="contents">
    <div class="container-fluid">
     <div class="social-dash-wrap">
        <div class="row">
           
 <div class="col-lg-12">
        
                <div class="breadcrumb-main">
                <h1>Devis</h1>
                     <div class="action-btn">
                            <a href="" class="btn btn-sm btn-primary btn-add">
                                <i class="la la-download"></i> Télécharger Devis</a>
                        </div>
                   
                </div>
            <form method="POST" action="save_devis.php">
            <div class="row">
                <table class="table" id="devisTable">
                        <tr>
                            <td>
                                <label for="date">Date:</label>
                            </td>
                            <td>
                                <input  type="date" name="date" class="form-control" value="<?php echo date('Y-m-d'); ?>" readonly>
                            </td>
                            <td>
                                <label for="client">Client:</label>
                            </td>
                            <td>
                                <select name="client" id="client" class="form-control select2" required>
                                    <option value="0" selected disabled>Select Client</option>
                                    <?php
                                    // Fetch client data from the database
                                    $sql = "SELECT id_client, nom_client FROM client";
                                    $stmt = $pdo->prepare($sql);
                                    $stmt->execute();
                                    $clients = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                    // Generate option elements based on the fetched client data
                                    foreach ($clients as $client) {
                                        echo '<option value="' . $client['id_client'] . '">' . $client['nom_client'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            
                        </tr>
                        <tr>
                         <td>
                             <label for="numero_devis">N° devis:</label>
                         </td>
                        <td>
                            <?php
                               
                                
                            // Retrieve the latest devis number from the database
                            $sql = "SELECT MAX(numero_devis) AS max_devis FROM devis";
                            $stmt = $pdo->prepare($sql);
                            $stmt->execute();
                            $result = $stmt->fetch(PDO::FETCH_ASSOC);

                            $latestDevisNumber = $result['max_devis'];

                            // Increment the latest devis number by 1 for the new devis
                            $nextDevisNumber = $latestDevisNumber ? $latestDevisNumber + 1 : 1;

                            // Format the devis number with leading zeros if needed
                            $formattedDevisNumber = str_pad($nextDevisNumber, 2, STR_PAD_LEFT);

                            $numeroDevis = $formattedDevisNumber;

                            ?>

                            <input type="number" name="numero_devis" class="form-control" value="<?php echo $numeroDevis; ?>" required>
                        </td>
                         </tr>
</table>


            <table class="table" id="articleTable">
                <thead>
                    <tr>
                        <th>CODE ARTICLE</th>
                        <th>DESIGNATION</th>
                        <th>QTE</th>
                        <th>PRIX HT</th>
                        <th>TOTAL HT</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <div class="col-md-6 mb-3">
                <tbody>
                    <tr>
                        <td>
                        
                        <select name="code_article[]" id="article" class="form-control select2" required>
                        <option value="0" selected disabled>Select Article</option>
                        <?php
                            // Fetch client data from the database
                            $sql = "SELECT id_article, code_article FROM article";
                            $stmt = $pdo->prepare($sql);
                            $stmt->execute();
                            $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            // Generate option elements based on the fetched client data
                            foreach ($articles as $article) {
                                echo '<option value="' . $article['id_article'] . '">' . $article['code_article'] . $article['designation'] . '</option>';
                            }
                        ?>
                    </select>
                    </td>
                            
                        <td><input type="text" value="<?php echo  $article['designation']?>" name="designation[]" class="form-control designation" required></td>
                            <td><input type="number" name="qte[]" class="form-control quantity" required></td>
                            <td><input type="number" name="prix_ht[]" class="form-control price" required></td>
                            <td><input type="number" name="total_ht[]" class="form-control amount" readonly></td>
                            <td><button type="button" class="btn btn-danger btn-sm delete-row">Delete</button></td>
                        </tr>
                    </tbody>
            </table>
            <button type="button" class="btn btn-primary mb-3" id="addRow">Add Row</button>
           
            <input type="submit" value="Submit" class="btn btn-success mb-3 " >
            </table>
        </form>
 
    </div>
            </div>

   
                
            </div>
        </div>
    
    </div>
</div>
</div>
<?php include("include/scripts.php")
?>
      



