                    <div class="main-panel">
			<div class="content">
				<div class="panel-header bg-primary-gradient">
					<div class="page-inner py-5">
						<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
							<div>
								<h2 class="text-black-50 pb-2 fw-bold">Dashboard</h2>
								<h5 class="text-black-50 op-7 mb-2">SETCRM v5 - Software de Call Center</h5>
							</div>
						</div>
					</div>
				</div>
				<div class="page-inner mt--5">
					<div class="row mt--2">
						<div class="col-md-6">
							<div class="card full-height">
								<div class="card-body">
									<div class="card-title">Estadísticas Generales</div>
									<div class="card-category">Conteos totales</div>
									<div class="d-flex flex-wrap justify-content-around pb-2 pt-4">
										<div class="px-2 pb-2 pb-md-0 text-center">
											<div id="total_clientes"><h1><?php echo Contact::countAll()->cantidad ?></h1></div>
											<h6 class="fw-bold mt-3 mb-0">Total Contactos</h6>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="card full-height">
								<div class="card-body">
									<div class="card-title">Total Llamadas</div>
									<div class="row py-3">
										<div class="col-md-4 d-flex flex-column justify-content-around">
											<div>
												<h6 class="fw-bold text-uppercase text-success op-8">Total Llamadas Inbound</h6>
												<h3 class="fw-bold">2222</h3>
											</div>
											<div>
												<h6 class="fw-bold text-uppercase text-danger op-8">Total Llamadas Outbound</h6>
                                                <h3 class="fw-bold">3333</h3>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>