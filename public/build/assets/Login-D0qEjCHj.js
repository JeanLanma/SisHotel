import{T as g,e as i,b as s,u as o,w as l,F as w,o as d,Z as x,t as b,f as c,a as t,n as k,g as h,i as y}from"./app-CNFf23ER.js";import{A as V}from"./AuthenticationCard-C1N4FQ2K.js";import{_ as v}from"./AuthenticationCardLogo-DonuP0rb.js";import{_ as B}from"./Checkbox-PEPzIe_Q.js";import{_ as u}from"./InputError-DQTM4jyo.js";import{_ as f}from"./InputLabel-5qBaUaxP.js";import{_ as C}from"./PrimaryButton--A80jWEN.js";import{_ as p}from"./TextInput-CVjuxNOj.js";import"./_plugin-vue_export-helper-DlAUqK2U.js";const $={key:0,class:"mb-4 font-medium text-sm text-green-600"},N={class:"mt-4"},F={class:"block mt-4"},U={class:"flex items-center"},q=t("span",{class:"ms-2 text-sm text-gray-600"},"Recordar sesión",-1),S={class:"flex items-center justify-end mt-4"},Z={__name:"Login",props:{canResetPassword:Boolean,status:String},setup(n){const e=g({login:"",password:"",remember:!1}),_=()=>{e.transform(m=>({...m,remember:e.remember?"on":""})).post(route("login"),{onFinish:()=>e.reset("password")})};return(m,a)=>(d(),i(w,null,[s(o(x),{title:"Ingresar al sistema"}),s(V,null,{logo:l(()=>[s(v)]),default:l(()=>[n.status?(d(),i("div",$,b(n.status),1)):c("",!0),t("form",{onSubmit:y(_,["prevent"])},[t("div",null,[s(f,{for:"login",value:"Usuario"}),s(p,{id:"login",modelValue:o(e).login,"onUpdate:modelValue":a[0]||(a[0]=r=>o(e).login=r),type:"text",class:"mt-1 block w-full",required:"",autofocus:"",autocomplete:"login"},null,8,["modelValue"]),s(u,{class:"mt-2",message:o(e).errors.login},null,8,["message"])]),t("div",N,[s(f,{for:"password",value:"Contraseña"}),s(p,{id:"password",modelValue:o(e).password,"onUpdate:modelValue":a[1]||(a[1]=r=>o(e).password=r),type:"password",class:"mt-1 block w-full",required:"",autocomplete:"current-password"},null,8,["modelValue"]),s(u,{class:"mt-2",message:o(e).errors.password},null,8,["message"])]),t("div",F,[t("label",U,[s(B,{checked:o(e).remember,"onUpdate:checked":a[2]||(a[2]=r=>o(e).remember=r),name:"remember"},null,8,["checked"]),q])]),t("div",S,[c("",!0),s(C,{class:k(["ms-4",{"opacity-25":o(e).processing}]),disabled:o(e).processing},{default:l(()=>[h(" Entrar ")]),_:1},8,["class","disabled"])])],32)]),_:1})],64))}};export{Z as default};
