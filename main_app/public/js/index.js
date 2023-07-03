document.addEventListener("DOMContentLoaded", function () {


    let paths = document.getElementsByClassName("path-class");
    let modal = document.createElement("div");
    modal.innerHTML = `
    <div class="modal fade right" id="sideModalBRDangerDemo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true" data-backdrop="false">
        <div class="modal-dialog modal-side modal-bottom-right modal-notify modal-primary" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <p class="heading">Portion details</p>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="white-text">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                    <div class="text-center">
                    <div class="col-lg-12 mr-3 text-center text-md-left">
                        <h4 class="h4-responsive pb-3 text-center text-md-left product-name font-weight-bold dark-grey-text mb-1 ml-xl-0 ml-4">
                            
                    
                        </h4>
                
                        <p class="ml-xl-0 ml-4 product-size">
                            
                        </p>
                        <p class="ml-xl-0 ml-4 product-price">
                            
                        </p>
                        <p class="ml-xl-0 ml-4 product-availability">
                            
                        </p>
                    </div>
                </div>
                
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <a id="save-button" type="button" class="btn  btn-sm btn-success"  data-dismiss="modal">Buy </a>
                    <a type="button" class="btn btn-sm btn-outline-primary waves-effect" data-dismiss="modal">No, thanks</a>
                </div>
            </div>
        </div>
    </div>
`;

    document.body.appendChild(modal);
    let saveButton = document.querySelector("#save-button");

    for (let i = 0; i < paths.length; i++) {
        paths[i].addEventListener("click", function () {
            let path = paths[i];
            let id = path.id;
            let color = "blue";

            let xhrHTTP = new XMLHttpRequest();
            xhrHTTP.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    let data = JSON.parse(this.responseText);
                    let portionName = document.querySelector(".product-name");
                    portionName.innerHTML = `<strong>Portion ${data.id}</strong>`;
                    let portionSize = document.querySelector(".product-size");
                    portionSize.innerHTML = `<strong>Size: </strong> <span class="badge  p-1 badge-info"> ${data.size}  </span>`;
                    let portionPrice = document.querySelector(".product-price");
                    portionPrice.innerHTML = `<strong>Price: </strong> Tsh  <span class="badge p-1 badge-info"> ${data.price}  </span>`;
                    let portionAvailability = document.querySelector(
                        ".product-availability"
                    );

                    if (data.status == "taken") {
                        portionAvailability.innerHTML = `<strong>Availability: </strong> <span class="badge p-1 badge-danger">${data.status} </span> `;
                    } else {
                        portionAvailability.innerHTML = `<strong>Availability: </strong> <span class="badge p-1 badge-info">${data.status} </span> `;
                    }
                }
            };

            xhrHTTP.open("GET", "http://127.0.0.1:8000/portion/" + id, true);
            xhrHTTP.setRequestHeader("Content-Type", "application/json");
            xhrHTTP.send();

            $("#sideModalBRDangerDemo").modal("show");
            saveButton.addEventListener("click", function () {
                let status = "reserved";
                path.style.fill = color;

                let pathElement = path.outerHTML;
                let xhr = new XMLHttpRequest();
                xhr.open("PUT", "/portions/" + id, true);
                xhr.setRequestHeader(
                    "Content-Type",
                    "application/json;charset=UTF-8"
                );
                xhr.setRequestHeader(
                    "X-CSRF-TOKEN",
                    document.querySelector('meta[name="csrf-token"]').content
                );
                xhr.send(
                    JSON.stringify({
                        fill: color,
                        status: status,
                        vector: pathElement,
                    })
                );

                modal.style.display = "none";
                location.reload();
            });
        });
    }
});


