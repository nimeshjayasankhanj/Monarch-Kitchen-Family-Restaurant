import type { Meta, StoryObj } from "@storybook/react";

import Layout from "./layout";

const meta: Meta<typeof Layout> = {
  title: "layout",
  component: Layout,
};

export default meta;
type Story = StoryObj<typeof Layout>;

export const Index: Story = {
  args: {
    children: "hello",
  },
};
