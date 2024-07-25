import {mount} from "@vue/test-utils";
import Welcome from "@/Pages/Welcome.vue";

const wrapper = mount(Welcome, {
    props: {
        canLogin: true,
        canRegister: true,
        laravelVersion: 11,
        phpVersion: 8
    }
});

it("shows login link", async () => {
    expect(wrapper.text()).toContain('Log in');
  });