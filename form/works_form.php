<form action="works.php" method="POST">
    <div id="add">
        <div style="text-align: left; padding-left:100px">   
            <h2><span title="Click to add works" class="show_add"> <a href="javascript:;"><span> <img src="../public/images/sq_plus_icon&24.png"  height="20px" class="img_an_hien"> </span>Add New Work</a></span></h2>
        </div>
        <table border="0" id="table_add">
        <tr>
            <td class="title">Work name: </td>
            <td><input type="text" name="name"></td>
        </tr>
         <tr>
             <td class="title">Url:</td>
            <td><input type="text" name="url"></td>
        </tr>
        <tr>
            <td class="title">Company - Name: </td>
            <td><input type="text" name="company_name"></td>
        </tr>
        <tr>
            <td class="title">Company - Location: </td>
            <td><input type="text" name="localtion"></td>
        </tr>
        <tr>
            <td class="title">Company - Address: </td>
            <td><input type="text" name="company_dress"></td>
        </tr>
        <tr>
            <td class="title">Company - Profile: </td>
            <td><textarea cols="5" name="company_profile"></textarea></td>
        </tr>
        <tr>
            <td class="title">Description: </td>
            <td><textarea cols="5" name="description"></textarea></td>
        </tr>
         <tr>
            <td class="title">Experience Requirements:</td>
            <td><textarea cols="5" name="experience_requirements"></textarea></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" name="submit" value="Add words"> <input type="reset" value="Reset"> Go to add <a href="keywords.php">Key word</a> ? </td>
        </tr>
    </table>
    </div><!-- End #add -->
</form>