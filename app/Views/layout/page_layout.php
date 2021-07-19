<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title><?=$page_titile ?? ""?></title>
  </head>
  <body>
        
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary" style="background-color: white;">
      <a class="navbar-brand" href="/">Nutech Product</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          
          <li class="nav-item">
            <a class="nav-link" href="/product/create" data-toggle="modal" data-target="#exampleModal">Add Product</a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link" href="/logout">Logout</a>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="search" placeholder="Search product..." aria-label="Search" id="search_product">
        </form>
      </div>
    </nav>
    <div style="height: 2em;" ></div>
    <div class="container-fluid">
      <?= $this->renderSection('content') ?>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <!-- Modal create-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="post" action="/product/create" enctype="multipart/form-data">    
              <div class="form-group row">
                  <label for="staticEmail" class="col-sm-2 col-form-label">Prodcut name</label>
                  <div class="col-sm-10">
                    <input type="text" name="name" class="form-control" placeholder="name product">
                  </div>
              </div>
              <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Price buy</label>
                  <div class="col-sm-10">
                    <input type="text" name="price_buy" class="form-control" placeholder="10000">
                  </div>
              </div>
              <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Price sell</label>
                  <div class="col-sm-10">
                    <input type="text" name="price_sell" class="form-control" placeholder="12000">
                  </div>
              </div>
              <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Stok</label>
                  <div class="col-sm-10">
                    <input type="text" name="stok" class="form-control" placeholder="12">
                  </div>
              </div>
              <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Upload image</label>
                  <div class="col-sm-10">
                    <input type="file" name="image" class="form-control">
                  </div>
              </div>
              <div class="form-group row">
                  <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Save</button>
                  </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <script>
      $(document).ready(function(){
          $("#search_product").on("keyup", function() {
              var value = $(this).val().toLowerCase();
              $("#content div.col-md-3").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
              });
          });
      });
    </script>
    <script>
        $(document).ready(function() {

            function getPageList(totalPages, page, maxLength) {
                if (maxLength < 5) throw "maxLength must be at least 5";

                function range(start, end) {
                    return Array.from(Array(end - start + 1), (_, i) => i + start);
                }

                var sideWidth = maxLength < 9 ? 1 : 2;
                var leftWidth = (maxLength - sideWidth * 2 - 3) >> 1;
                var rightWidth = (maxLength - sideWidth * 2 - 2) >> 1;
                if (totalPages <= maxLength) {
                    // no breaks in list
                    return range(1, totalPages);
                }
                if (page <= maxLength - sideWidth - 1 - rightWidth) {
                    // no break on left of page
                    return range(1, maxLength - sideWidth - 1)
                    .concat([0])
                    .concat(range(totalPages - sideWidth + 1, totalPages));
                }
                if (page >= totalPages - sideWidth - 1 - rightWidth) {
                    // no break on right of page
                    return range(1, sideWidth)
                    .concat([0])
                    .concat(
                        range(totalPages - sideWidth - 1 - rightWidth - leftWidth, totalPages)
                    );
                }
            // Breaks on both sides
                return range(1, sideWidth)
                    .concat([0])
                    .concat(range(page - leftWidth, page + rightWidth))
                    .concat([0])
                    .concat(range(totalPages - sideWidth + 1, totalPages));
                }

$(function() {
  // Number of items and limits the number of items per page
  var numberOfItems = $("#content .content").length;
  var limitPerPage = 4;
  // Total pages rounded upwards
  var totalPages = Math.ceil(numberOfItems / limitPerPage);
  // Number of buttons at the top, not counting prev/next,
  // but including the dotted buttons.
  // Must be at least 5:
  var paginationSize = 7;
  var currentPage;

  function showPage(whichPage) {
    if (whichPage < 1 || whichPage > totalPages) return false;
    currentPage = whichPage;
    $("#content .content")
      .hide()
      .slice((currentPage - 1) * limitPerPage, currentPage * limitPerPage)
      .show();
    // Replace the navigation items (not prev/next):
    $(".pagination li").slice(1, -1).remove();
    getPageList(totalPages, currentPage, paginationSize).forEach(item => {
      $("<li>")
        .addClass(
          "page-item " +
            (item ? "current-page " : "") +
            (item === currentPage ? "active " : "")
        )
        .append(
          $("<a>")
            .addClass("page-link")
            .attr({
              href: "javascript:void(0)"
            })
            .text(item || "...")
        )
        .insertBefore("#next-page");
    });
    return true;
  }

  // Include the prev/next buttons:
  $(".pagination").append(
    $("<li>").addClass("page-item").attr({ id: "previous-page" }).append(
      $("<a>")
        .addClass("page-link")
        .attr({
          href: "javascript:void(0)"
        })
        .text("Prev")
    ),
    $("<li>").addClass("page-item").attr({ id: "next-page" }).append(
      $("<a>")
        .addClass("page-link")
        .attr({
          href: "javascript:void(0)"
        })
        .text("Next")
    )
  );
  // Show the page links
  $("#content").show();
  showPage(1);

  // Use event delegation, as these items are recreated later
  $(
    document
  ).on("click", ".pagination li.current-page:not(.active)", function() {
    return showPage(+$(this).text());
  });
  $("#next-page").on("click", function() {
    return showPage(currentPage + 1);
  });

  $("#previous-page").on("click", function() {
    return showPage(currentPage - 1);
  });
  $(".pagination").on("click", function() {
    $("html,body").animate({ scrollTop: 0 }, 0);
  });
});

        })
    </script>
    <?= $this->include('layout\alert') ?>
  </body>
</html>