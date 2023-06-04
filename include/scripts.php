<div id="overlayer">
        <span class="loader-overlay">
            <div class="atbd-spin-dots spin-lg">
                <span class="spin-dot badge-dot dot-primary"></span>
                <span class="spin-dot badge-dot dot-primary"></span>
                <span class="spin-dot badge-dot dot-primary"></span>
                <span class="spin-dot badge-dot dot-primary"></span>
            </div>
        </span>
    </div>
    <div class="overlay-dark-sidebar"></div>

    <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDduF2tLXicDEPDMAtC6-NLOekX0A5vlnY"></script>
    <!-- inject:js-->
    <script src="assets/vendor_assets/js/jquery/jquery-3.5.1.min.js"></script>
    <script src="assets/vendor_assets/js/jquery/jquery-ui.js"></script>
    <script src="assets/vendor_assets/js/bootstrap/popper.js"></script>
    <script src="assets/vendor_assets/js/bootstrap/bootstrap.min.js"></script>
    <script src="assets/vendor_assets/js/moment/moment.min.js"></script>
    <script src="assets/vendor_assets/js/accordion.js"></script>
    <script src="assets/vendor_assets/js/autoComplete.js"></script>
    <script src="assets/vendor_assets/js/Chart.min.js"></script>
    <script src="assets/vendor_assets/js/charts.js"></script>
    <script src="assets/vendor_assets/js/daterangepicker.js"></script>
    <script src="assets/vendor_assets/js/drawer.js"></script>
    <script src="assets/vendor_assets/js/dynamicBadge.js"></script>
    <script src="assets/vendor_assets/js/dynamicCheckbox.js"></script>
    <script src="assets/vendor_assets/js/feather.min.js"></script>
    <script src="assets/vendor_assets/js/footable.min.js"></script>
    <script src="assets/vendor_assets/js/fullcalendar@5.2.0.js"></script>
    <script src="assets/vendor_assets/js/google-chart.js"></script>
    <script src="assets/vendor_assets/js/jquery-jvectormap-2.0.5.min.js"></script>
    <script src="assets/vendor_assets/js/jquery-jvectormap-world-mill-en.js"></script>
    <script src="assets/vendor_assets/js/jquery.countdown.min.js"></script>
    <script src="assets/vendor_assets/js/jquery.filterizr.min.js"></script>
    <script src="assets/vendor_assets/js/jquery.magnific-popup.min.js"></script>
    <script src="assets/vendor_assets/js/jquery.mCustomScrollbar.min.js"></script>
    <script src="assets/vendor_assets/js/jquery.peity.min.js"></script>
    <script src="assets/vendor_assets/js/jquery.star-rating-svg.min.js"></script>
    <script src="assets/vendor_assets/js/leaflet.js"></script>
    <script src="assets/vendor_assets/js/leaflet.markercluster.js"></script>
    <script src="assets/vendor_assets/js/loader.js"></script>
    <script src="assets/vendor_assets/js/message.js"></script>
    <script src="assets/vendor_assets/js/moment.js"></script>
    <script src="assets/vendor_assets/js/muuri.min.js"></script>
    <script src="assets/vendor_assets/js/notification.js"></script>
    <script src="assets/vendor_assets/js/popover.js"></script>
    <script src="assets/vendor_assets/js/select2.full.min.js"></script>
    <script src="assets/vendor_assets/js/slick.min.js"></script>
    <script src="assets/vendor_assets/js/trumbowyg.min.js"></script>
    <script src="assets/vendor_assets/js/wickedpicker.min.js"></script>
    <script src="assets/theme_assets/js/drag-drop.js"></script>
    <script src="assets/theme_assets/js/footable.js"></script>
    <script src="assets/theme_assets/js/full-calendar.js"></script>
    <script src="assets/theme_assets/js/googlemap-init.js"></script>
    <script src="assets/theme_assets/js/icon-loader.js"></script>
    <script src="assets/theme_assets/js/jvectormap-init.js"></script>
    <script src="assets/theme_assets/js/leaflet-init.js"></script>
    <script src="assets/theme_assets/js/main.js"></script>

    <!-- endinject-->

    <script>

        $(document).ready(function() {
        $('.select2').select2()
           
        $("#addRow").click(function () {
            var row = `<tr>
                        
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
                                            echo '<option value="' . $article['id_article'] . '">' . $article['code_article'] . '</option>';
                                        }
                                    ?>
                                 </select>
                                </td>
                        <td><input type="number" name="designation[]" class="form-control designation" required></td>
                        <td><input type="number" name="quantity[]" class="form-control quantity" required></td>
                        <td><input type="number" name="price[]" class="form-control price" required></td>
                        <td><input type="number" name="amount[]" class="form-control amount" readonly></td>
                        <td><button type="button" class="btn btn-danger btn-sm delete-row">Delete</button></td>
                    </tr>`;

                     $("#articleTable tbody").append(row);
                $('.select2').select2();
            });

            // Delete row
            $(document).on("click", ".delete-row", function () {
                $(this).closest("tr").remove();
            });   

            // Calculate amount when quantity or price changes
            $(document).on("change keyup", ".quantity, .price", function () {
                var quantity = $(this).closest("tr").find(".quantity").val();
                var price = $(this).closest("tr").find(".price").val();
                var amountField = $(this).closest("tr").find(".amount");

                var amount = parseFloat(quantity) * parseFloat(price);
                amountField.val(amount.toFixed(2));
            });
        });

    </script>
</body>

</html>