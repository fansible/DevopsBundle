# /!\ Deprecated /!\
See https://github.com/fansible/tywin for the newer version.

# FansibleDevopsBundle

This will help you to generate a Ansible provisioning to run your Symfony apps.

##Requirements
This have been tested with the Ubuntu OS. It should work with many other various Linux distribution. Feel free to share your advice for the other OS..
You will need to install if you haven't done yet:

* [Ansible](http://docs.ansible.com/intro_installation.html)
* [Composer](https://getcomposer.org/download/)
* [Vagrant](http://www.vagrantup.com/downloads.html)
* [VirtualBox](https://www.virtualbox.org/wiki/Downloads).
* nfs `sudo apt-get install nfs-kernel-server`

1) Install the bundle

    composer require fansible/devops-bundle *@dev --dev

2) Enable the bundle in the `app/AppKernel.php` file, for development environment only.

```
if (in_array($this->getEnvironment(), array('dev', 'test'))) {
    /* After other dev dependencies... */
    $bundles[] = new \Fansible\DevopsBundle\FansibleDevopsBundle();
}
```

3) Add the following in your configuration in `app/config/config_dev.yml`

    fansible_devops:
      #Name of your project
      name: fansible-devops
      environments:
        vagrant:
          ip: 10.0.0.10
          host: fansible-devops.dev
          #Those vars will be used to generate the VagrantFile
          #box: ubuntu/trusty64
          #memory: 1024
          #cpus: 1
          #exec: 100
          #src: .
          #dest: /var/www/fansible-devops/current
        prod:
          ip: x.x.x.x
          host: fansible-devops.prod
      #Specific role you want to use
      ansible_roles:
    #      apache:
    #        name: THEROLEYOUWANT #you can found many roles on ansible galaxy
    #        version: v24

4) Add your host in your hostfile: `sudo /bin/bash -c "echo '10.0.0.10  fansible-devops.dev' >> /etc/hosts"`

5) Now you can use our command to generate all the files you need to your provisioning.
`app/console generate:provisioning`

6) To be able to correctly provision your server, ansible needs some role that are describe in the requirements.txt file.
You need to download them by running
`ansible-galaxy install -r requirements.txt`.

7) Now you can run `vagrant up` to start your vagrant. It is lunched using the Vagrantfile that we have just generated.
