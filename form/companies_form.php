<form action="companies.php" method="POST">
    <div id="add">
        <div style="text-align: left; padding-left:100px">   

            <h2> <span title="Click to add works" class="show_add"><a href="javascript:;"> <span> <img src="../public/images/sq_plus_icon&24.png"  height="20px" class="img_an_hien"> </span>Add New Companies</a></span></h2>
        </div>
        <table border="0" id="table_add">
        <tr>
            <td class="title">Name: </td>
            <td><input type="text" name="name"></td>
        </tr>
         <tr>
             <td class="title">Website:</td>
            <td><input type="text" name="website"></td>
        </tr>
        <tr>
            <td class="title">Phone: </td>
            <td><input type="text" name="phone"></td>
        </tr>
        <tr>
            <td class="title">Address: </td>
            <td><input type="text" name="address"></td>
        </tr>
        <tr>
            <td class="title">Status: </td>
            <td><input type="text" name="status"></td>
        </tr>
        <tr>
            <td class="title">Notes</td>
            <td><textarea cols="5" name="notes"></textarea></td>
        </tr>
        <tr>
            <td class="title">Description: </td>
            <td><textarea cols="5" name="description"></textarea></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" name="submit" value="Add"> <input type="reset" value="Reset"> Go to add <a href="keywords.php">Key word</a> ? </td>
        </tr>
    </table>
    </div><!-- End #add -->
</form>