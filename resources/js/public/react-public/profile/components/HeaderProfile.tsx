import * as React from "react";

const HeaderProfile = ({ user , followers , following}) => {
    console.log(user)
  return (
    <div className="w-full bg-white shadow-xl rounded-2xl">
      <div className="rounded-t-2xl h-32 overflow-hidden">
        {/* <img className="object-cover object-top w-full" src={`/users/header/${user.headerImage.url}`} alt="header" /> */}
      </div>
      <div className="container mx-auto">
        <div className="flex justify-between">
          <div className="w-32 h-32 relative -mt-16 border-4 border-white rounded-full overflow-hidden">
            {user.profileImage ? (
            //   <img className="object-cover rounded-full" src={`/users/profile/${user.profileImage.url}`} alt={user.profileImage.alt} />
                <p>mohsen</p>
            ) : (
            //   <img
            //     className="object-cover rounded-full"
            //     src={`/users/profile/${user.sex === 2 ? "female.png" : "male.png"}`}
            //     alt={user.name}
            //   />
            <p>mohsen</p>
            )}
          </div>
          <div>
            <ul className="py-4 mt-2 text-gray-700 flex items-center justify-around gap-x-14">
              <li className="flex flex-col items-center justify-around text-xl font-bold gap-y-2">
                12
                <div>Posts</div>
              </li>
              <li className="flex flex-col items-center justify-around text-xl font-bold gap-y-2">
                {following}
                <h1>followings</h1>
              </li>
              <li className="flex flex-col items-center justify-around text-xl font-bold gap-y-2">
                {followers}
                <h1>followers</h1>
              </li>
            </ul>
          </div>
        </div>
        <div className="flex justify-between">
          <div className="">
            <p className="font-bold text-2xl">
              {user.fname} {user.lname}
            </p>
            <p className="text-darkGray font-bold text-base mt-1">{user.title}</p>
          </div>
          <div className="flex justify-end -space-x-4 rtl:space-x-reverse">
            {[1, 2, 3].map((index) => (
            <p>mohsen2</p>
            //   <img key={index} className="w-8 h-8 border-2 border-white rounded-full" src={`/website/profile/avatar1.png`} alt="" />
            ))}
            <a className="flex items-center justify-center w-8 h-8 text-md font-medium text-mediumGray bg-lightGray border-2 border-mediumGray rounded-full" href="#">
              +4
            </a>
          </div>
        </div>
        <div>
          <p className="text-sm my-5 text-ellipsis overflow-hidden">{user.about_me}</p>
        </div>
        <div className="flex justify-between">
          <div className="flex gap-5">
            {/* <img src={`/website/profile/instagram.svg`} alt="Instagram" />
            <img src={`/website/profile/facebook.svg`} alt="Facebook" />
            <img src={`/website/profile/LinkedIn.svg`} alt="LinkedIn" /> */}
          </div>
          <div className="flex items-center gap-5 pb-5">
            <button className="btn bg-orange text-white font-bold text-base rounded-2xl w-28">Follow</button>
            <button className="btn bg-white text-orange font-bold text-base border-2 border-orange rounded-2xl w-28">Message</button>
            <button>
              {/* <img src={`/website/profile/moreButton.svg`} alt="More" /> */}
            </button>
          </div>
        </div>
      </div>
    </div>
  );
};

export default HeaderProfile;
