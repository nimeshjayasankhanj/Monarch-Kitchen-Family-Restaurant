import type { Meta, StoryObj } from "@storybook/react";

import Button from "./index";

const meta: Meta<typeof Button> = {
  title: "Button",
  component: Button,
};

export default meta;
type Story = StoryObj<typeof Button>;

export const Index: Story = {
  args: {
    title: "Button",
  },
  argTypes: {
    type: {
      options: ["primary", "ghost", "dashed", "link", "text", "default"],
      control: { type: "radio" },
    },
  },
};
