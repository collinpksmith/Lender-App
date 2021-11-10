<template>
	<div class="d-flex justify-content-between align-items-center mb-2">
		<h2>{{name}}</h2>

    <b-button variant="success" :to="{ name: addLink }">
			Add
		</b-button>
	</div>
</template>

<script>
export default {
	name: 'TableHeader',

	props: {
		name: {
			type: String,
		},

		addLink: {
			type: String,
		},
	},
}
</script>
