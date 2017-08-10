<!--        <style>
            #search {
                background-color: lightyellow;
                outline: medium none;
                padding: 8px;
                width: 300px;
                border-radius: 2px;
                -moz-border-radius: 3px;
                -webkit-border-radius: 3px;
                border-radius: 3px;
                border: 2px solid orange;
            }

            ul {
                width: 300px;
                margin: 0px;
                padding-left: 0px;
            }

            ul li {
                list-style: none;
                background-color: lightgray;
                margin: 1px;
                padding: 1px;
                -moz-border-radius: 3px;
                -webkit-border-radius: 3px;
                border-radius: 3px;
            }
        </style>-->

        <!--<script type="text/javascript" language="javascript" src="http://www.technicalkeeda.com/js/javascripts/plugin/jquery.js"></script>-->
        <!--<script type="text/javascript" src="http://www.technicalkeeda.com/js/javascripts/plugin/json2.js"></script>-->

<!--</head>-->
<!--<body>-->
<div id="wrapper">
    <div id="content">
        <input type="text" name="search" id="search" />
        <!--<ul id="finalResult">-->
        <!--</ul>-->
        <table width="100%" border="0" cellpadding="1" cellspacing="1">
            <thead>
                <tr>
                    <th width="7%" >S No.</th>
                    <th width="17%">Name</th>
                    <th width="10%">Date</th>
                    <th width="30%">Car</th>
                    <th width="10%">Color</th>
                    <th width="10%">Mobile No.</th>
                    <th width="15%">Detail</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <td colspan="7"><div id="paging">
                            <ul>
                                <li><a href=""><span>Previous</span></a></li>
                                <li><a href="" class="active"><span>1</span></a></li>
                                <li><a href=""><span>2</span></a></li>
                                <li><a href=""><span>3</span></a></li>
                                <li><a href=""><span>4</span></a></li>
                                <li><a href=""><span>5</span></a></li>
                                <li><a href=""><span>Next</span></a></li>
                            </ul>
                        </div>
                </tr>
            </tfoot>
            <tbody id="finalResult">
                <tr id="rbRes">
<!--                    <td class="resId" name="resId"></td>
                    <td class="tbl-name"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><a href="">Loss</a> / <a href="">Edit</a> / <?php //echo anchor('', 'Delete', array('onClick' => "return confirm('Are you sure you want to delete?')"));   ?></td>-->
                </tr>
            </tbody>
        </table>
    </div>
</div>