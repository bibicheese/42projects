/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   unsetenv.c                                         :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: jmondino <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/09/17 15:15:33 by jmondino          #+#    #+#             */
/*   Updated: 2019/09/19 20:27:35 by jmondino         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "minishell.h"

static void		memdel_fill_struct(t_shell *shell, char **newenv)
{
	ft_memdel((void **) shell->env);
	shell->env = array_cpy(newenv);
	ft_memdel((void **) newenv);
	ft_memdel((void **) shell->paths);
	shell->paths = paths(shell->env);
	ft_memdel((void **) shell->renv);
	ft_memdel((void **) shell->lenv);
	shell->renv = renv(shell->env);
	shell->lenv = lenv(shell->env);
}

static void     erase(char *arg, t_shell *shell)
{
    int     i;
	int		j;
    char    **newenv;
	char	**var;

    i = 0;
	j = 0;
	while (shell->env[i])
		i++;
	if (!(newenv = (char **)malloc(sizeof(char *) * i)))
		return ;
	i = 0;
	while (shell->env[i])
	{
		var = ft_strsplit(shell->env[i], "=");
		if (!ft_strcmp(var[0], arg))
			i++;
		else
			newenv[j++] = ft_strdup(shell->env[i++]);
		ft_memdel((void **) var);
	}
	newenv[j] = NULL;
	memdel_fill_struct(shell, newenv);
}

static int		parsing(char *arg, t_shell *shell)
{
	int		i;
	char	**var;

	i = 0;
	while (shell->env[i])
	{
		var = ft_strsplit(shell->env[i], "=");
		if (!ft_strcmp(var[0], arg))
		{
			ft_memdel((void **) var);
			return (1);
		}
		i++;
		ft_memdel((void **) var);
	}
	return (0);
}

void	ft_unsetenv(char **args, t_shell *shell)
{
    if (!args[1] || args[2])
        ft_putstr("usage: unsetenv VARNAME\n");
    else
    {
        if (parsing(args[1], shell) && shell->env)
			erase(args[1], shell);
        else
		{
			ft_putstr("unsetenv: ");
			ft_putstr(args[1]);
			ft_putstr(": No such variable\n");
		}
    }
}
