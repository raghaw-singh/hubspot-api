<?php $segment_1    =   $this->uri->segment(1);?>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Logo</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link <?php if($segment_1=='' || $segment_1=='company-list') echo 'active';?>" href="<?= base_url('company-list');?>">Company List</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
