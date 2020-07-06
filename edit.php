<?php
  session_start();
  include_once 'header.php';
?>
<section class="main-container">
    <div class="main-wrapper">
        <h1 style="text-align:center;"><b>
        <?php
        include 'includes/dbh.inc.php';
        $uid = $_GET['id'];
        $name = $_GET['name'];
        echo "Student ID: ";
        echo $uid;
        echo "<br>";
        echo "Editing: ";
        echo $name;
        ?></b></h1>
        <script type="text/javascript">
            function setForm(value) {
                if(value == 'Completed'){
                document.getElementById('Completed').style='display:block;';
                document.getElementById('Planned').style='display:none;';
                document.getElementById('Not Taken').style='display:none;';
                }
                if(value == 'Planned'){
                    document.getElementById('Planned').style = 'display:block;';
                    document.getElementById('Completed').style = 'display:none;';
                    document.getElementById('Not Taken').style = 'display:none;';
                }
                if(value == 'Not Taken'){
                    document.getElementById('Not Taken').style = 'display:block;';
                    document.getElementById('Completed').style = 'display:none;';
                    document.getElementById('Planned').style='display:none;';
                }
        }
        </script> <br><br>
            <body>
            <div class="nav-login">
            <form>
            <label>Completion Status:</label>
                <select id="select1" onchange="setForm(this.value)">
                <option value="Completed">Completed</option>
                <option value="Planned">Planned</option>
                <option value="Not Taken">Not Taken</option>
                </select><br><br>
                </form>
                <?php echo'
                <div id="Completed">
                    <form name="Completed" action="includes/edit.inc.php?id='.$uid.'&name='.$name.'" onsubmit="return validateForm()" method="POST">
                        <input type="hidden" name="completionStatus" value="Completed" >
                        Term: <select name="term" required>
                                    <option value="Fall ">Fall</option>
                                    <option value="Winter ">Winter</option>
                                    <option value="Spring ">Spring</option>
                                    <option value="Summer ">Summer</option>
                                    <option value="" selected> </option>
                                </select>
                        Year: <select name="year" required>
                                    <option value="2019">2019</option>
                                    <option value="2018">2018</option>
                                    <option value="2017">2017</option>
                                    <option value="2016">2016</option>
                                    <option value="2015">2015</option>
                                    <option value="2014">2014</option>
                                    <option value="2013">2013</option>
                                    <option value="2012">2012</option>
                                    <option value="2011">2011</option>
                                    <option value="2010">2010</option>
                                    <option value="2009">2009</option>
                                    <option value="2008">2008</option>
                                    <option value="2007">2007</option>
                                    <option value="2006">2006</option>
                                    <option value="2005">2005</option>
                                    <option value="2004">2004</option>
                                    <option value="2003">2003</option>
                                    <option value="2003">2003</option>
                                    <option value="2002">2002</option>
                                    <option value="2002">2002</option>
                                    <option value="2000">2000</option>
                                    <option value="1999">1999</option>
                                    <option value="" selected> </option>
                                </select>
                                <br><br>
                        Grade: <select name="grade" required>
                                    <option value="A">A</option>
                                    <option value="B+">B+</option>
                                    <option value="B">B</option>
                                    <option value="B-">B-</option>
                                    <option value="C+">C+</option>
                                    <option value="C">C</option>
                                    <option value="CR">CR</option>
                                    <option value="" selected> </option>
                                </select>
                                <br><br>
                        Comments: <input type="text" name="comments">
                        <input type="hidden" name="completionTerm" id="completionTerm" value="" >
                        <br><br>
                        <button type="submit" name="submit">Update</button>
                    </form><hr>
                    <script>
                        function validateForm() {
                            var x = document.forms["Completed"]["grade"].value;
                            var y = document.forms["Completed"]["term"].value;
                            var z = document.forms["Completed"]["year"].value;
                            if (x == "" && y == "" && z == "") {
                                alert("Term, year and grade must be entered");
                                return false;
                            }
                            if (x == "") {
                                alert("Grade must be entered");
                                return false;
                            }
                            if (y == "") {
                                alert("Term must be entered");
                                return false;
                            }
                            if (z == "") {
                                alert("Year must be entered");
                                return false;
                            }
                            else{
                                var completionTerm = y.concat(z);
                                document.Completed.completionTerm.value = completionTerm;
                                document.forms["Completed"].submit();
                            }     
                        }
                    </script>
                </div>
                <div id="Planned" style="display: none">
                    <form name="Planned" class="" action="includes/edit.inc.php?id='.$uid.'&name='.$name.'" onsubmit="return setValue()" method="POST">
                    <input type="hidden" name="completionStatus" value="Planned" >
                    Term: <select name="term" required>
                                    <option value="Fall ">Fall</option>
                                    <option value="Winter ">Winter</option>
                                    <option value="Spring ">Spring</option>
                                    <option value="Summer ">Summer</option>
                                    <option value="" selected> </option>
                                </select>
                        Year: <select name="year" required>
                                    <option value="2019">2019</option>
                                    <option value="2020">2020</option>
                                    <option value="2021">2021</option>
                                    <option value="2022">2022</option>
                                    <option value="2023">2023</option>
                                    <option value="2024">2024</option>
                                    <option value="" selected> </option>
                                </select>
                                <br><br>
                    Comments: <input type="text" name="comments" >
                    <input type="hidden" name="plannedTerm" id="plannedTerm" value="" >
                    <br><br>
                    <button type="submit" name="submit">Update</button>
                    </form><hr>
                    <script>
                        function setValue() {
                            var a = document.forms["Planned"]["term"].value;
                            var b = document.forms["Planned"]["year"].value;
                            if (a == "" && b !== "") {
                                alert("Term must be entered");
                                return false;
                            }
                            if (a !== "" && b == "") {
                                alert("Year must be entered");
                                return false;
                            }
                            else{
                                var plannedTerm = a.concat(b);
                                document.Planned.plannedTerm.value = plannedTerm;
                                document.forms["Planned"].submit();
                            }     
                        }
                    </script>
                </div>
                <div id="Not Taken" style="display: none">
                    <form name="Not Taken" class="" action="includes/edit.inc.php?id='.$uid.'&name='.$name.'" onsubmit="return setValue()" method="POST">
                    <input type="hidden" name="completionStatus" value="Not Taken" >
                    <br><br>
                    <button type="submit" name="submit">Update</button>
                    </form>
                </form><hr>
                </div>
                '; ?>
                </div>
            </body>
    </div>
</section>    
<?php
    include_once 'footer.php';
?>