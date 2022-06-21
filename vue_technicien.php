<div class="container mt-4">
	<div class="row d-flex justify-content-center">
		<div class="col-auto">
			<div class="card">
				<div class="card-header">
					<h3 class="text-center">
						Ajout d'un technicien
					</h3>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container mt-4 mb-10">
	<div class="row d-flex justify-content-center">
		<div class="card bg-secondary text-light" style="max-width: 35rem;">
			<form method="post" action="">
				<div class="card-body">
					<div class="mb-3">
						<label for="nom" class="form-label h5">Nom</label>
						<input type="text" name="nom" id="nom" class="form-control">
					</div>
					<div class="mb-3">
						<label for="prenom" class="form-label h5">Prénom</label>
						<input type="text" name="prenom" id="prenom" class="form-control">
					</div>
					<div class="mb-3">
						<label for="email" class="form-label h5">Adresse email</label>
						<input type="text" name="email" id="email" class="form-control">
					</div>
					<div class="mb-3">
						<label for="mdp" class="form-label h5">Mot de passe</label>
						<input type="password" name="mdp" id="mdp" class="form-control">
					</div>
					<div class="mb-3">
						<label for="qualification" class="form-label h5">Qualification</label>
						<input type="text" name="qualification" id="qualification" class="form-control">
					</div>
				</div>
				<div class="card-footer">
					<div class="row d-flex justify-content-center">
						<div class="col-6">
							<button type="reset" class="btn btn-danger btn-lg w-100">Annuler</button>
						</div>
						<div class="col-6">
							<button type="submit" name="ValiderTechnicien" class="btn btn-dark btn-lg w-100">Valider</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>