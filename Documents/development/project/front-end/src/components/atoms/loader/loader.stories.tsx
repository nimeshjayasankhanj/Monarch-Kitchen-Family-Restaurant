import type { Meta, StoryObj } from "@storybook/react";

import Loader from "./index";

const meta: Meta<typeof Loader> = {
  title: "loader",
  component: Loader,
};

export default meta;
type Story = StoryObj<typeof Loader>;

export const Index: Story = {};
