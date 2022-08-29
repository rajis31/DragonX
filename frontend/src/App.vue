<template>
  <router-view></router-view>
</template>

<style scoped>
</style>

<script>
import createApp from '@shopify/app-bridge';
import { isShopifyEmbedded } from '@shopify/app-bridge-utils';
import { Redirect } from '@shopify/app-bridge/actions';
export default {
  mounted() {
    const apiKey       = '91e985092d5546317fcd5a4dd24f4243';
    const redirectUri  = 'https://dragonx.dev-top.com/register/" + "codeinspire-shop-2"';
    const urlParams    = new URLSearchParams(window.location.href);
    let host           = urlParams.get("HOST") ? urlParams.get("HOST") :
                         this.$store.getters.getHost;
    this.$store.commit("setHost",host);

    const permissionUrl = `https://${host}/admin/oauth/authorize?client_id=${apiKey}
                           &scope=read_products,write_products,read_customers,write_customers,read_inventory,write_inventory
                           &redirect_uri=${redirectUri}`;

    console.log(host);

    if (isShopifyEmbedded()) {
      const app = createApp({
        apiKey: apiKey,
        host: host
      });

      Redirect.create(app).dispatch(Redirect.Action.REMOTE, permissionUrl);
    }

  }
}
</script>