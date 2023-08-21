<script setup lang="ts">
import {Head, Link} from '@inertiajs/vue3';
import {Application} from "@/Layouts";

defineProps<{
  canLogin?: boolean;
  canRegister?: boolean;
  laravelVersion: string;
  phpVersion: string;
}>();
</script>

<template>
  <Head title="Welcome"/>

  <Application></Application>
</template>
