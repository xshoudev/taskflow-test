<div id="container" class="container">
		<!-- FORM SECCIÓN -->
		<div class="row-main">
			<!-- REGISTRARSE -->
			<div class="col align-items-center flex-col sign-up" id="test-1">
                <form method="post" id="register-form">
                    <div class="form-wrapper align-items-center">
                        <div class="form sign-up">
                            <div class="input-group">
                                <i class='bx bxs-user'></i>
                                <input type="text" name="name" placeholder="Nombre" autocomplete="off" required>
                            </div>
                            <div class="input-group">
                                <i class='bx bx-mail-send'></i>
                                <input type="email" name="email" placeholder="Email" autocomplete="off" required>
                            </div>
                            <div class="input-group">
                                <i class='bx bxs-lock-alt'></i>
                                <input type="password" name="password" placeholder="Contraseña" autocomplete="off" required>
                            </div>
                            <button type="submit" id="register-button">
                                Registrate
                            </button>
                            <p>
                                <span>
                                    ¿Ya tienes una cuenta?
                                </span>
                                <b onclick="toggle()" class="pointer">
                                    Inicia sesión aquí
                                </b>
                            </p>
                        </div>
                    </div>
                </form>
			</div>
			<!-- TERMINA REGISTRARSE -->
			<!-- INICIAR SESION -->
			<div class="col align-items-center flex-col sign-in" id="test-2">
			<form method="post" id="login-form">
				<div class="form-wrapper align-items-center">
					<div class="form sign-in">
						<div class="input-group">
							<i class='bx bxs-user'></i>
							<input type="text" placeholder="Email" autocomplete="off" name="email" required>
						</div>
						<div class="input-group">
							<i class='bx bxs-lock-alt'></i>
							<input type="password" placeholder="Contraseña" id="password" autocomplete="off" name="password" required>
						</div>
						<button type="submit">
							Iniciar sesión
						</button>
						<p>
							<span>
								¿Aún no tienes una cuenta?
							</span>
							<b onclick="toggle()" class="pointer">
								¡Registrate aquí!
							</b>
						</p>
					</div>
				</div>
				<div class="form-wrapper">
		
				</div>
			</form>
			</div>
			<!-- TERMINA INICIAR SESION -->
		</div>
		<!-- TERMINA FORM -->
		<!-- SECCION CONTENT -->
		<div class="row-main content-row">
			<!-- INICIAR SESION CONTENIDO -->
             
			<div class="col align-items-center flex-col">
				<div class="text sign-in">
					<h2>
						¡Bienvenido!
					</h2>
                    <h5>Haz que tu tiempo cuente.</h5>
	
				</div>
				<div class="img sign-in">
		
				</div>
			</div>
			<!-- TERMINA INICIAR SESION SECCION -->
			<!-- REGISTRARSE CONTENIDO -->
			<div class="col align-items-center flex-col">
				<div class="img sign-up">
				
				</div>
				<div class="text sign-up">
					<h2>
						¡Unete!
					</h2>
                    <h5>
                        Tu productividad y gestión, a otro nivel.
                    </h5>
	
				</div>
			</div>
			<!-- TERMINA REGISTRARSE CONTENIDO -->
		</div>
		<!-- TERMINA SECCION CONTENIDO -->
	</div>
