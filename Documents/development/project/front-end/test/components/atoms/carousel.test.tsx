import "@testing-library/jest-dom";
import { screen, render } from "@testing-library/react";
import Carousel from "@/components/atoms/carousel";

const data = [
  {
    image:
      "https://images.pexels.com/photos/1545743/pexels-photo-1545743.jpeg?cs=srgb&dl=pexels-yurii-hlei-1545743.jpg&fm=jpg",
  },
];

describe("carousel component", () => {
  test("should be render carousel component", () => {
    render(<Carousel data={data} />);
    expect(screen.findAllByAltText(/image/!));
  });
});
