import React from "react";

const ButtonComponent = ({ type = "button" }) => {
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