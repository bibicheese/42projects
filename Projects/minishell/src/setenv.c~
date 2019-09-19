/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   setenv.c                                           :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: jmondino <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/09/17 11:13:11 by jmondino          #+#    #+#             */
/*   Updated: 2019/09/19 21:33:41 by jmondino         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "minishell.h"

static int		parsing(char *arg)
{
	int		i;
	int		ok;

	ok = 0;
	i = 0;
	while (arg[i])
	{
		if (arg[i] == '=')
		{
			if (arg[i + 1] && arg[i + 1] != ' ' && arg[i + 1] != '\t')
				ok++;
		}
		i++;
	}
	return (ok);
}

static char		**fill(char *arg, t_shell *shell, char *value)
{
	int		i;
	int		add;
	char	**newenv;

	i = 0;
	add = 1;
	while (shell->env[i])
		i++;
	if (!(newenv = malloc(sizeof(char *) * (i + 2))))
		return NULL;
	i = -1;
	while (shell->env[++i])
	{
		if (!ft_strcmp(shell->lenv[i], value))
		{
			add = 0;
			newenv[i] = ft_strdup(arg);
		}
		else
			newenv[i] = ft_strdup(shell->env[i]);
	}
	if (add)
		newenv[i++] = ft_strdup(arg);
	newenv[i] = NULL;
	return (newenv);
}

static void		fill_newenv(char *arg, t_shell *shell)
{
	if (!(shell->env = malloc(sizeof(char *) * 2)))
		return ;
	shell->env[0] = ft_strdup(arg);
	shell->env[1] = NULL;
	shell->lenv = lenv(shell->env);
}

static void		fill_env(char *arg, t_shell *shell)
{
	char	**newenv;
	char	**value;
	
	value = ft_strsplit(arg, "=");
	newenv = fill(arg, shell, value[0]);
	ft_memdel((void **) value);
	ft_memdel((void **) shell->env);
	shell->env = array_cpy(newenv);
	ft_memdel((void **) newenv);
	ft_memdel((void **) shell->paths);
    shell->paths = paths(shell->env);
	ft_memdel((void **) shell->lenv);
	ft_memdel((void **) shell->renv);
	shell->lenv = lenv(shell->env);
	shell->renv = renv(shell->env);
}

void	ft_setenv(t_shell *shell, char **args)
{
	if (!args[1] || args[2])
		ft_putstr("usage: setenv VARNAME=VALUE\n");
	else
	{
		if (parsing(args[1]))
		{
			if (shell->env)
				fill_env(args[1], shell);
			else
				fill_newenv(args[1], shell);
		}
		else
			ft_putstr("usage: setenv VARNAME=VALUE\n");
	}
}
