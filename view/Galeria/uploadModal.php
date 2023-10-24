<div class="modal fade modal-upload-default" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="modal-close" data-dismiss="modal" aria-label="Close">
                        <i class="font-icon-close-2"></i>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Upload File</h4>
                </div>
                <div class="modal-upload">
                    <div class="modal-upload-cont">
                        <div class="modal-upload-cont-in">
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="tab-upload">
                                    <div class="modal-upload-body scrollable-block">
                                        <div class="uploading-container">
                                            <div class="uploading-container-left">
                                                <div class="drop-zone">
                                                    <!--
                                                    при перетаскиваении добавляем класс .dragover
                                                    <div class="drop-zone dragover">
                                                    -->
                                                    <i class="font-icon font-icon-cloud-upload-2"></i>
                                                    <div class="drop-zone-caption">Drag file to upload</div>
                                                    <span class="btn btn-rounded btn-file">
                                                        <span>Choose file</span>
                                                        <form action="">
                                                            <input type="file" class="form-control" id="file" name="file" />
                                                        </form>
                                                        
                                                    </span>
                                                </div>
                                            </div><!--.uploading-container-left-->
                                            <div class="uploading-container-right">
                                                <div class="uploading-container-right-in">
                                                    <h6 class="uploading-list-title">Subiendo</h6>
                                                    <ul class="uploading-list">
                                                        <li class="uploading-list-item">
                                                            <div class="uploading-list-item-wrapper">
                                                                <div class="uploading-list-item-name">
                                                                    <i class="font-icon font-icon-cam-photo"></i>
                                                                    photo.png
                                                                </div>
                                                                <div class="uploading-list-item-size">7,5 mb</div>
                                                                <button type="button" class="uploading-list-item-close">
                                                                    <i class="font-icon-close-2"></i>
                                                                </button>
                                                            </div>
                                                            <div class="progress">
                                                                <span class="progress-bar" style="width: 25%;"></span>
                                                            </div>
                                                            <div class="uploading-list-item-progress">37% done</div>
                                                            <div class="uploading-list-item-speed">90KB/sec</div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div><!--.uploading-container-right-->
                                        </div><!--.uploading-container-->
                                    </div><!--.modal-upload-body-->
                                    <div class="modal-upload-bottom">
                                        <button type="button" class="btn btn-rounded btn-default">Cancel</button>
                                        <button type="button" class="btn btn-rounded">Done</button>
                                    </div><!--.modal-upload-bottom-->
                                </div><!--.tab-pane-->
                                <!-- <div role="tabpanel" class="tab-pane" id="tab-google-drive">
                                    <div class="modal-upload-body scrollable-block">
                                        <div class="upload-gd-header">
                                            <div class="tbl-row">
                                                <div class="tbl-cell">
                                                    <input type="text" class="form-control form-control-rounded" placeholder="Search"/>
                                                </div>
                                                <div class="tbl-cell tbl-cell-btns">
                                                    <button type="button">
                                                        <i class="font-icon font-icon-cam-photo"></i>
                                                    </button>
                                                    <button type="button">
                                                        <i class="font-icon font-icon-cam-video"></i>
                                                    </button>
                                                    <button type="button">
                                                        <i class="font-icon font-icon-sound"></i>
                                                    </button>
                                                    <button type="button">
                                                        <i class="font-icon font-icon-page"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="gd-doc-grid">
                                            <div class="gd-doc-col">
                                                <div class="gd-doc">
                                                    <div class="gd-doc-preview">
                                                        <a href="#">
                                                            <img src="img/doc.jpg" alt="">
                                                        </a>
                                                    </div>
                                                    <div class="gd-doc-title">History Class Final</div>
                                                    <div class="gd-doc-date">05/30/2014</div>
                                                </div>
                                            </div>
                                             <div class="gd-doc-col">
                                                <div class="gd-doc">
                                                    <div class="gd-doc-preview">
                                                        <a href="#">
                                                            <img src="img/doc.jpg" alt="">
                                                        </a>
                                                    </div>
                                                    <div class="gd-doc-title">History Class Final</div>
                                                    <div class="gd-doc-date">05/30/2014</div>
                                                </div>
                                            </div>
                                             <div class="gd-doc-col">
                                                <div class="gd-doc">
                                                    <div class="gd-doc-preview">
                                                        <a href="#">
                                                            <img src="img/doc.jpg" alt="">
                                                        </a>
                                                    </div>
                                                    <div class="gd-doc-title">History Class Final</div>
                                                    <div class="gd-doc-date">05/30/2014</div>
                                                </div>
                                            </div>
                                             <div class="gd-doc-col">
                                                <div class="gd-doc">
                                                    <div class="gd-doc-preview">
                                                        <a href="#">
                                                            <img src="img/doc.jpg" alt="">
                                                        </a>
                                                    </div>
                                                    <div class="gd-doc-title">History Class Final</div>
                                                    <div class="gd-doc-date">05/30/2014</div>
                                                </div>
                                            </div>
                                             <div class="gd-doc-col">
                                                <div class="gd-doc">
                                                    <div class="gd-doc-preview">
                                                        <a href="#">
                                                            <img src="img/doc.jpg" alt="">
                                                        </a>
                                                    </div>
                                                    <div class="gd-doc-title">History Class Final</div>
                                                    <div class="gd-doc-date">05/30/2014</div>
                                                </div>
                                            </div>
                                             <div class="gd-doc-col">
                                                <div class="gd-doc">
                                                    <div class="gd-doc-preview">
                                                        <a href="#">
                                                            <img src="img/doc.jpg" alt="">
                                                        </a>
                                                    </div>
                                                    <div class="gd-doc-title">History Class Final</div>
                                                    <div class="gd-doc-date">05/30/2014</div>
                                                </div>
                                            </div>
                                             <div class="gd-doc-col">
                                                <div class="gd-doc">
                                                    <div class="gd-doc-preview">
                                                        <a href="#">
                                                            <img src="img/doc.jpg" alt="">
                                                        </a>
                                                    </div>
                                                    <div class="gd-doc-title">History Class Final</div>
                                                    <div class="gd-doc-date">05/30/2014</div>
                                                </div>
                                            </div>
                                             <div class="gd-doc-col">
                                                <div class="gd-doc">
                                                    <div class="gd-doc-preview">
                                                        <a href="#">
                                                            <img src="img/doc.jpg" alt="">
                                                        </a>
                                                    </div>
                                                    <div class="gd-doc-title">History Class Final</div>
                                                    <div class="gd-doc-date">05/30/2014</div>
                                                </div>
                                            </div>
                                             <div class="gd-doc-col">
                                                <div class="gd-doc">
                                                    <div class="gd-doc-preview">
                                                        <a href="#">
                                                            <img src="img/doc.jpg" alt="">
                                                        </a>
                                                    </div>
                                                    <div class="gd-doc-title">History Class Final</div>
                                                    <div class="gd-doc-date">05/30/2014</div>
                                                </div>
                                            </div>
                                             <div class="gd-doc-col">
                                                <div class="gd-doc">
                                                    <div class="gd-doc-preview">
                                                        <a href="#">
                                                            <img src="img/doc.jpg" alt="">
                                                        </a>
                                                    </div>
                                                    <div class="gd-doc-title">History Class Final</div>
                                                    <div class="gd-doc-date">05/30/2014</div>
                                                </div>
                                            </div>
                                             <div class="gd-doc-col">
                                                <div class="gd-doc">
                                                    <div class="gd-doc-preview">
                                                        <a href="#">
                                                            <img src="img/doc.jpg" alt="">
                                                        </a>
                                                    </div>
                                                    <div class="gd-doc-title">History Class Final</div>
                                                    <div class="gd-doc-date">05/30/2014</div>
                                                </div>
                                            </div>
                                             <div class="gd-doc-col">
                                                <div class="gd-doc">
                                                    <div class="gd-doc-preview">
                                                        <a href="#">
                                                            <img src="img/doc.jpg" alt="">
                                                        </a>
                                                    </div>
                                                    <div class="gd-doc-title">History Class Final</div>
                                                    <div class="gd-doc-date">05/30/2014</div>
                                                </div>
                                            </div>
                                             <div class="gd-doc-col">
                                                <div class="gd-doc">
                                                    <div class="gd-doc-preview">
                                                        <a href="#">
                                                            <img src="img/doc.jpg" alt="">
                                                        </a>
                                                    </div>
                                                    <div class="gd-doc-title">History Class Final</div>
                                                    <div class="gd-doc-date">05/30/2014</div>
                                                </div>
                                            </div>
                                             <div class="gd-doc-col">
                                                <div class="gd-doc">
                                                    <div class="gd-doc-preview">
                                                        <a href="#">
                                                            <img src="img/doc.jpg" alt="">
                                                        </a>
                                                    </div>
                                                    <div class="gd-doc-title">History Class Final</div>
                                                    <div class="gd-doc-date">05/30/2014</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-upload-bottom">
                                        <button type="button" class="btn btn-rounded">Select</button>
                                        <button type="button" class="btn btn-rounded btn-default">Cancel</button>
                                    </div>
                                </div> -->
                            </div><!--.tab-content-->
                        </div><!--.modal-upload-cont-in-->
                    </div><!--.modal-upload-cont-->
                    <div class="modal-upload-side">
                        <ul class="upload-list" role="tablist">
                            <li class="nav-item">
                                <a href="#tab-upload" role="tab" data-toggle="tab" class="active">
                                    <i class="font-icon font-icon-cloud-upload-2"></i>
                                    <span>Upload</span>
                                </a>
                            </li>
                            <!-- <li class="nav-item">
                                <a href="#tab-google-drive" role="tab" data-toggle="tab">
                                    <i class="font-icon font-icon-google-drive"></i>
                                    <span>Google Drive</span>
                                </a>
                            </li> -->
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--.modal-->