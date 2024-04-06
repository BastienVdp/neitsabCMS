<?php 

$nav = [
	[
		"route" => "/admin",
		"label" => "Dashboard",
		"active" => self::isCurrentPath("/admin")
	], 
	[
		"route" => "/admin/products",
		"label" => "Produits",
		"active" => self::isCurrentPathStartWith("/admin/products")
	],
	[
		"route" => "/admin/categories",
		"label" => "Catégories",
		"active" => self::isCurrentPathStartWith("/admin/categories")
	],
	[
		"route" => "/admin/users",
		"label" => "Utilisateurs",
		"active" => self::isCurrentPathStartWith("/admin/users")
	]
];
?>

<!DOCTYPE html>
<html lang="fr" class="h-full bg-gray-100">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Administration</title>
	<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/forms@0.5.6/src/index.min.js"></script>
	<script src="https://cdn.tailwindcss.com"></script>
	<style>.alert { color: red;}</style>
</head>
<body class="h-full">
	<div class="min-h-full">
		<nav class="bg-gray-800">
			<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
				<div class="flex h-16 items-center justify-between">
					<div class="flex items-center">
						<div class="flex-shrink-0">
							<img class="h-8 w-8" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=500" alt="Your Company">
						</div>
						<div class="hidden md:block">
							<div class="ml-10 flex items-baseline space-x-4">
								<?php foreach($nav as $item): ?>
								<a 
									href="<?= $item['route'] ?>" 
									class="<?= $item['active'] ? 'bg-gray-900 text-white' : 'text-gray-300' ?> hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">
									<?= $item['label'] ?>
								</a>
								<?php endforeach; ?>
							</div>
						</div>
					</div>
					<div class="hidden md:block">
						<div class="ml-4 flex items-center md:ml-6">
							<div class="relative ml-3 flex items-center gap-3">
								<a href="/" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Retour au site</a>
								<a href="/logout" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Déconnexion</a>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Mobile menu, show/hide based on menu state. -->
			<div class="md:hidden" id="mobile-menu">
				<div class="space-y-1 px-2 pb-3 pt-2 sm:px-3">
				<?php foreach($nav as $item): ?>
					<a 
						href="<?= $item['route'] ?>" 
						class="<?= $item['active'] ? 'bg-gray-900 text-white' : 'text-gray-300' ?> block hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">
						<?= $item['label'] ?>
					</a>
				<?php endforeach; ?>
				</div>
				<div class="border-t border-gray-700 pb-3 pt-4">
					<div class="flex flex-col px-5 gap-4">
						<div class="text-base font-medium leading-none text-white">Username</div>
						<div class="text-sm font-medium leading-none text-gray-400">email</div>
					</div>
					<div class="mt-3 space-y-1 px-2">
						<a href="/" class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white">Retour au site</a>
						<a href="/logout" class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white">Déconnexion</a>
					</div>
				</div>
			</div>
		</nav>		
		{{ content }}
	</div>
</body>
</html>