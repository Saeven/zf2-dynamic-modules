# Dynamic Module Loader

I needed a means to dynamically wire modules into ZF2.  This overrides the ModuleManager to create a system where closure conditions can be used to modify the application config's module array.
