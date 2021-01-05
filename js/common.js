// Search the books
function searchFunc(event) {
    event.preventDefault();
    // Get keyword from search bar
    keyword = document.getElementById("searchBar").value.toLowerCase();
    // Set the href value to point to search reuslt page 
    window.location.href = "./search.html?keyword=" + keyword;
};