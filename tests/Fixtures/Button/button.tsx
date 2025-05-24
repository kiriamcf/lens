import React from "react";

type ButtonProps = {
  type?: string;
};

const ButtonComponent: React.FC<ButtonProps> = ({
  type = "button",
}) => {
  return (
    <>
      {/* ✅ Good: Specifies type */}
      <button type={type}>Click me</button>

      {/* ⚠️ Bad: Missing type */}
      <button>Click me</button>
    </>
  );
};

export default ButtonComponent;