document.addEventListener("DOMContentLoaded", function () {
    let paths = document.getElementsByClassName("path-class");
    let modal = document.createElement("div");
    modal.innerHTML = `
    <div class="modal fade right" id="sideModalBRDangerDemo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog modal-side modal-bottom-right modal-notify modal-primary" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <p class="heading">EDIT | Portion details</p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <div class="col-lg-12 mr-3 text-center text-md-left">
                        <h6
                            class="h6-responsive text-center text-md-left product-name font-weight-bold dark-grey-text mb-1 ml-xl-0 ml-4">
                        </h6>
                        <div class="row mt-4">
                            <div class="col m-auto">
                                <p class="product-status"></p>
                            </div>
                            <div class="col m-auto">
                                <p class="product-size"></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col m-auto">
                                <p class="product-price"></p>
                            </div>
                            <div class="col m-auto">
                                <p class="product-owner"></p>
                            </div>
                        </div>
                        <h6
                            class="h6-responsive text-center text-md-left  font-weight-bold dark-grey-text mb-1 mt-3 ml-xl-0 ml-4">
                            Edit details
                        </h6>
                        <div class="row">
                            <div class="col m-auto">
                                <div class="md-form form-sm">
                                    <input type="text" id="portion-size" class="form-control form-control"
                                        value="">
                                    <label for="portion-size">Size - sqm</label>
                                </div>
                            </div>
                            <div class="col m-auto">
                                <select class="mdb-select md-form" id="portion-status">
                                    <option value="free">free</option>
                                    <option value="reserved">reserved</option>
                                    <option value="taken">taken</option>
                                    <option value="disabled">disabled</option>
                                </select>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-center">
                <button id="save-button" type="button" class="btn btn-sm btn-primary"
                    data-dismiss="modal">Save</button>
                <button type="button" class="btn btn-outline-primary btn-sm waves-effect" data-dismiss="modal">No,
                    thanks</button>
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

            let xhrHTTP = new XMLHttpRequest();
            xhrHTTP.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    let data = JSON.parse(this.responseText);
                    let portionName = document.querySelector(".product-name");
                    let portionPrice = document.querySelector(".product-price");
                    let portionOwner = document.querySelector(".product-owner");
                    let portionSize = document.querySelector(".product-size");
                    let portionStatus =
                        document.querySelector(".product-status");
                    if (data.size != null) {
                        portionName.innerHTML = `<strong> Portion ${data.id} </strong> <span class="badge badge-success product ml-2">filled</span> `;
                    } else {
                        portionName.innerHTML = `<strong> Portion ${data.id} </strong>`;
                    }
                    if (data.price != null) {
                        portionPrice.innerHTML = `<strong>Price: </strong> Tsh ${data.price}`;
                    } else {
                        portionPrice.innerHTML = `<strong>Price: </strong> not set`;
                    }

                    if (data.owner != null) {
                        portionOwner.innerHTML = `<strong>Resved by: </strong> ${data.user_id}`;
                    } else {
                        portionOwner.innerHTML = `<strong>Resved by: </strong> none`;
                    }

                    if (data.size != null) {
                        portionSize.innerHTML = `<strong>Size: </strong> ${data.size} SQM`;
                    } else {
                        portionSize.innerHTML = `<strong>Size: </strong> not set`;
                    }

                    if (data.status != null) {
                        portionStatus.innerHTML = `<strong>Status: </strong> ${data.status}`;
                    } else {
                        portionStatus.innerHTML = `<strong>Status: </strong> not reserved`;
                    }
                }
            };

            xhrHTTP.open("GET", "http://127.0.0.1:8000/portion/" + id, true);
            xhrHTTP.setRequestHeader("Content-Type", "application/json");
            xhrHTTP.send();

            $("#sideModalBRDangerDemo").modal("show");
            saveButton.addEventListener("click", function () {
                let portionSizeInput = document.querySelector("#portion-size");
                let portionStatusInput =
                    document.querySelector("#portion-status");
                let size = portionSizeInput.value;
                let status = portionStatusInput.value;
                let color = "";

                if (status == "reserved") {
                    color = "blue";
                } else if (status == "taken") {
                    color = "red";
                } else if (status == "disabled") {
                    color = "white";
                    path.style.pointerEvents = "none";
                } else {
                    color = "";
                }

                path.style.fill = color;
                let pathElement = path.outerHTML;
                let xhr = new XMLHttpRequest();
                xhr.open("PUT", "/manage_portions/" + id, true);
                xhr.setRequestHeader(
                    "Content-Type",
                    "application/json;charset=UTF-8"
                );
                xhr.setRequestHeader(
                    "X-CSRF-TOKEN",
                    document.querySelector('meta[name="csrf-token"]').content
                );
                console.log(xhr);

                xhr.send(
                    JSON.stringify({
                        size: size,
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

