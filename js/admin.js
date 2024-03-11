
$("#addGigIcon").click((e) => openEditPage("add", undefined));
$(".editIcon").click((e) => openEditPage("edit", e.target.parentNode.parentNode.getAttribute("gigid")));
$(".deleteIcon").click((e) => deleteItem(e.target.parentNode.parentNode.getAttribute("gigid")));


function openEditPage(method, id) {
    console.log("Open edit page with method \"" + method + "\" and id \"" + id + "\"");
 }

 function deleteItem(id) {
    console.log("deleeeete " + id);
 }