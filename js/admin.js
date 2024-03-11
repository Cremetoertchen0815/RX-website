

$("#addGigIcon").click((e) => openEditPage(""));
$(".editIcon").click((e) => openEditPage(e.target.parentNode.parentNode.getAttribute("gigid")));
$(".deleteIcon").click((e) => deleteItem(e.target.parentNode.parentNode.getAttribute("gigid")));


function openEditPage(id) {
    const form = document.getElementById("editPageForm");
    form.action = "/admin/edit.php";
    form.querySelector('input[name="id"]').value = id;
    form.submit();
 }

 function deleteItem(id) {
    const form = document.getElementById("editPageForm");
    form.action = "/admin/api/delete.php";
    form.querySelector('input[name="id"]').value = id;
    form.submit();
 }