<?php
include_once __DIR__.'/inc/header.php'; ?>
    <div class="container mt-5">
        <div class="card p-3">
            <h3>All users </h3>
            <div class="card-body vendor-table">
                <table class="table table-striped display" id="userTable">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Gender</th>
                            <th>City</th>
                            <th>State</th>
                            <th>Zipcode</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php require 'inc/footer.php';?>
    <script type="text/javascript">
        $(document).ready(function() {

            datatable_init();

        });

        function datatable_init() {
            const APP_URL = $('#app-url').val();
            var columns = [{
                    data: 'id'
                }, {
                    data: 'first_name'
                },
                {
                    data: 'last_name'
                },
                {
                    data: 'email'
                },

                {
                    data: 'gender'
                },
                {
                    data: 'city'
                },
                {
                    data: 'state'
                },
                {
                    data: 'zipcode'
                },
                {
                    data: 'action'
                }

            ];
            let url = APP_URL + 'api/list';
            let defaults = {
                responsive: true,
                bDestroy: true,
                bSearchable: true,
                deferRender: true,
                serverSide: true,
                processing: true,
                paging: true,
                // drawCallback: changeListCheck,
                language: {
                    searchPlaceholder: 'Search...',
                    sSearch: '',
                    lengthMenu: '_MENU_ ',
                },
                lengthMenu: [
                    [10, 25, 50, 100, ],
                    [10, 25, 50, 100]
                ],
                bAutoWidth: false,
                ajax: {
                    url: url
                },
                method: "GET",
                columns: columns,
                pageLength: 10,
                searching: true,
            };
            var table = $('#userTable').DataTable(defaults);
            console.log(defaults);
        }

        function deleteUser(id) {
            const APP_URL = $('#app-url').val();
            $.post(APP_URL + "api/delete", {
                    'id': id
                })
                .done(function(data) {
                    console.log(data)
                    let responseData;
                    try {
                        responseData = JSON.parse(data); // Try to parse JSON
                    } catch (error) {
                        responseData = data; // If not JSON, keep the original response as is
                    }
                    if (responseData.status == "Error") {
                        return false;
                    }
                    alert(responseData.message);
                    datatable_init();
                });

        }
    </script>
    </body>

    </html>