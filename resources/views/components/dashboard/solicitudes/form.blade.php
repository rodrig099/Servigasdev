<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Realizar una solicitud</h5>
                </div>
                <div class="card-body">
                    <form>
                    <div class="mb-3">
                        <label for="exampleFormControlSelect1" class="form-label">Seleccione el tipo de solicitud</label>
                        <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example">
                          <option selected>Tipo de solicitud</option>
                          <option value="1">Revisión</option>
                          <option value="2">Certificación</option>
                          <option value="3">Mantenimiento</option>
                        </select>
                      </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-icon-default-message">Message</label>
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-message2" class="input-group-text"><i class="bx bx-comment"></i></span>
                                <textarea
                                    id="basic-icon-default-message"
                                    class="form-control"
                                    placeholder="Cuentanos un poco más sobre tu solicitud"
                                    aria-label="Cuentanos un poco más sobre tu solicitud"
                                    aria-describedby="basic-icon-default-message2"></textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
